<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = ['message', 'url', 'method', 'client_type', 'user_id', 'ip_address', 'timestamp', 'session_id', 'previous_url', 'query_string', 'headers', 'payload', 'stack_trace', 'status_code', 'status'];

    protected $casts = [
        'status' => 'bool',
    ];
}
