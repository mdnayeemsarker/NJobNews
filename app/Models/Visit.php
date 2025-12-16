<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address', 'user_agent', 'url', 'visited_at', 'method', 'session_id', 'previous_url', 'query_string', 'headers', 'payload', 'stack_trace'];
}
