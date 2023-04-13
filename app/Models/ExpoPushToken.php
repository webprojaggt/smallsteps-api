<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpoPushToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'user_id',
        'active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
