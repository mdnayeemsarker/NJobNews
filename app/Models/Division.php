<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'bn_name', 'status', 'slug', 'lat', 'lon', 'website', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    /**
     * Get the districts for the division.
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
