<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'sms',
        'reply_id',
        'deleted_at',
    ];
}
