<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255'
        ]);

        $email = $request->email;
        
        // Check if already subscribed
        $existing = DB::table('newsletter_subscriptions')
            ->where('email', $email)
            ->first();
            
        if ($existing) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This email is already subscribed to our newsletter.'
                ]);
            }
            return back()->with('error', 'This email is already subscribed.');
        }
        
        // Add new subscription
        DB::table('newsletter_subscriptions')->insert([
            'email' => $email,
            'subscribed_at' => now(),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!'
            ]);
        }

        return back()->with('status', 'Thank you for subscribing to our newsletter!');
    }
}