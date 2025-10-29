<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'admin_user_id',
        'question',
        'answer',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
