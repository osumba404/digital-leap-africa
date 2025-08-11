<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ELibraryResource extends Model
{
    use HasFactory;

    protected $table = 'elibrary_resources';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'file_url',
        'image_url',
    ];
}