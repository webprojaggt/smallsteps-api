<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    public function news() {
        return $this->hasMany(News::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_topics_of_disinterest');
    }
}
