<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Upload extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type', 'file_path', 'file_name', 'original_name', 'extension', 'size', 'mime_type', 'file_type', 'is_public', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($upload) {
            $upload->user_id = Auth::id();
        });
    }
}
