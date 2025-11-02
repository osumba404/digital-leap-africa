<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Payment Successful - Welcome to ' . $this->payment->course->title)
                    ->view('emails.payment-success')
                    ->with([
                        'userName' => $this->payment->user->name,
                        'courseName' => $this->payment->course->title,
                        'amount' => $this->payment->amount,
                        'courseUrl' => route('courses.show', $this->payment->course),
                    ]);
    }
}