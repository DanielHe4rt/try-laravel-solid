<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'user_messages';

    protected $fillable = [
        'user_id',
        'content',
        'is_private',
        'receiver_username'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
