<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSourceLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'type',
        'title',
        'link'
    ];

    public function news() {
        return $this->belongsTo(News::class);
    }
}
