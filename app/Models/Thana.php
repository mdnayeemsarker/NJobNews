<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'bn_name', 'status', 'slug', 'lat', 'lon', 'website', 'district_id', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    /**
     * Get the district that owns the thana.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
