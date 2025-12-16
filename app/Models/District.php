<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'bn_name', 'status', 'slug', 'lat', 'lon', 'website', 'division_id', 'meta_title', 'meta_keywords', 'meta_description'
    ];
    protected $casts = [
        'status' => 'bool',
    ];
    /**
     * Get the division that owns the district.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get the thanas for the district.
     */
    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }
}
