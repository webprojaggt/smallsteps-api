<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsExternalLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'link',
        'image_url',
        'title',
        'description'
    ];

    public function news() {
        return $this->belongsTo(News::class);
    }
}
