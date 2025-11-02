<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\GamificationPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $consumerKey;
    private $consumerSecret;
    private $passkey;
    private $shortcode;
    private $callbackUrl;
    
    public function __construct()
    {
        $this->consumerKey = env('MPESA_CONSUMER_KEY');
        $this->consumerSecret = env('MPESA_CONSUMER_SECRET');
        $this->passkey = env('MPESA_PASSKEY');
        $this->shortcode = env('MPESA_SHORTCODE');
        $this->callbackUrl = env('MPESA_CALLBACK_URL') ?: url('/mpesa/callback');
    }
    
    private function getAccessToken()
    {
        $url = env('MPESA_ENV') === 'live' 
            ? 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            
        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)->get($url);
        
        return $response->json()['access_token'] ?? null;
    }
    
    public function initiate(Request $request, Course $course)
    {
        $request->validate([
            'phone_number' => 'required|regex:/^254[0-9]{9}$/',
        ]);
        
        $user = Auth::user();
        
        // Check if already enrolled
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this course.');
        }
        
        // Check if course is free
        if ($course->is_free) {
            return back()->with('error', 'This course is free. No payment required.');
        }
        
        $accessToken = $this->getAccessToken();
        
        if (!$accessToken) {
            Log::error('Failed to get M-Pesa access token');
            return back()->with('error', 'Payment system unavailable. Please try again later.');
        }
        
        Log::info('M-Pesa access token obtained successfully');
        
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);
        
        $url = env('MPESA_ENV') === 'live'
            ? 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest'
            : 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        
        $response = Http::withToken($accessToken)->post($url, [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) $course->price,
            'PartyA' => $request->phone_number,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $request->phone_number,
            'CallBackURL' => $this->callbackUrl,
            'AccountReference' => 'Course-' . $course->id,
            'TransactionDesc' => 'Payment for ' . $course->title,
        ]);
        
        $result = $response->json();
        
        Log::info('M-Pesa STK Push Response', $result);
        
        if (isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'merchant_request_id' => $result['MerchantRequestID'],
                'checkout_request_id' => $result['CheckoutRequestID'],
                'phone_number' => $request->phone_number,
                'amount' => $course->price,
                'status' => 'pending',
            ]);
            
            Log::info('Payment record created', ['payment_id' => $payment->id, 'checkout_request_id' => $payment->checkout_request_id]);
            
            return redirect()->route('payment.status', ['payment' => $payment->id])
                ->with('success', 'Payment request sent! Please check your phone to complete the payment.');
        }
        
        Log::error('M-Pesa STK Push failed', $result);
        $errorMessage = $result['errorMessage'] ?? $result['ResponseDescription'] ?? 'Payment initiation failed. Please try again.';
        return back()->with('error', $errorMessage);
    }
    
    public function callback(Request $request)
    {
        $data = $request->all();
        Log::info('M-Pesa Callback', $data);
        
        $resultCode = $data['Body']['stkCallback']['ResultCode'] ?? null;
        $checkoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'] ?? null;
        
        $payment = Payment::where('checkout_request_id', $checkoutRequestID)->first();
        
        if (!$payment) {
            Log::error('Payment not found for CheckoutRequestID: ' . $checkoutRequestID);
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Payment not found']);
        }
        
        if ($resultCode == '0') {
            // Payment successful - extract receipt number from callback metadata
            $mpesaReceiptNumber = null;
            $callbackMetadata = $data['Body']['stkCallback']['CallbackMetadata']['Item'] ?? [];
            
            // Find the MpesaReceiptNumber in the callback metadata
            foreach ($callbackMetadata as $item) {
                if (isset($item['Name']) && $item['Name'] === 'MpesaReceiptNumber') {
                    $mpesaReceiptNumber = $item['Value'];
                    break;
                }
            }
            
            $payment->markAsCompleted($mpesaReceiptNumber, $data);
            
            // Enroll user in course with active status (if not already enrolled)
            if (!$payment->user->courses()->where('course_id', $payment->course_id)->exists()) {
                $payment->user->courses()->attach($payment->course_id, [
                    'status' => 'active',
                    'enrolled_at' => now()
                ]);
            }
            
            // Award enrollment points
            GamificationPoint::create([
                'user_id' => $payment->user_id,
                'points' => 20,
                'reason' => 'Enrolled in course: ' . $payment->course->title,
            ]);
            
            // Award purchase points
            GamificationPoint::create([
                'user_id' => $payment->user_id,
                'points' => 100,
                'reason' => 'Purchased premium course: ' . $payment->course->title,
            ]);
            
            // Send in-app notification
            Notification::createNotification(
                $payment->user_id,
                'payment_success',
                'Payment Successful',
                "Your payment for {$payment->course->title} was successful. You are now enrolled and can start learning!",
                route('courses.show', $payment->course_id)
            );
            
            // Send email notification using our email service
            try {
                \App\Services\EmailNotificationService::sendNotification('payment_success', $payment->user, [
                    'payment' => $payment,
                    'course' => $payment->course
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send payment success email: ' . $e->getMessage());
            }
        } else {
            // Payment failed
            $payment->markAsFailed($data);
        }
        
        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
    
    public function checkStatus(Payment $payment)
    {
        // Ensure user can only check their own payment
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('payments.status', compact('payment'));
    }
    
    public function pollStatus(Payment $payment)
    {
        // Ensure user can only check their own payment
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return response()->json([
            'status' => $payment->status,
            'course_id' => $payment->course_id,
        ]);
    }
}