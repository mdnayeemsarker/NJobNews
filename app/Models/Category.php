<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'image_url', 'is_menu', 'is_home', 'in_order', 'status', 'slug', 'user_id', 'meta_title', 'meta_tag', 'meta_description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->user_id = Auth::id();
            if (empty($category->slug)) {
                $category->slug = generateUniqueSlug($category->title, static::class);
            }
        });
    }
    protected $casts = [
        'is_home' => 'bool',
        'status' => 'bool',
    ];
}
