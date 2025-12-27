<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsWorker extends Model
{
    use HasFactory;

    protected $fillable = ['receiver', 'body', 'body_second', 'sender', 'first_sms', 'second_sms', 'third_sms', 'status'];
    
}
