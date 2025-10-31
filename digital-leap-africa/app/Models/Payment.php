<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'merchant_request_id',
        'checkout_request_id',
        'mpesa_receipt_number',
        'phone_number',
        'amount',
        'status',
        'response_data',
        'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'response_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function markAsCompleted($mpesaReceiptNumber, $responseData = null)
    {
        $this->update([
            'status' => 'completed',
            'mpesa_receipt_number' => $mpesaReceiptNumber,
            'paid_at' => now(),
            'response_data' => $responseData,
        ]);
    }

    public function markAsFailed($responseData = null)
    {
        $this->update([
            'status' => 'failed',
            'response_data' => $responseData,
        ]);
    }
}