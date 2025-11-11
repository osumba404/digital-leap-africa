<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'background_color',
        'text_color',
        'signature_image',
        'logo_image',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}