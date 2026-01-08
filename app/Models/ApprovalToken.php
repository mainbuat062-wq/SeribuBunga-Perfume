<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'expired_at',
        'used_at'
    ];

    protected $dates = ['expired_at', 'used_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
