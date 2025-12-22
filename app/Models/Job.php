<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'apply_value', 'salary', 'vacancy', 'company', 'educational', 'experience', 'additional', 'thumb', 'attachment', 'type', 'gender', 'apply', 'category_id', 'division_id', 'district_id', 'thana_id', 'user_id', 'location', 'source_link', 'slug', 'status', 'description', 'meta_title', 'meta_keyword', 'meta_description', 'views'];

    /**
     * Get the category that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
