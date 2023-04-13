<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'created_by',
        'news_category_id',
        'title',
        'desc',
        'image_path',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function newsCategory() {
        return $this->belongsTo(NewsCategory::class);
    }

    public function sourceLinks() {
        return $this->hasMany(NewsSourceLink::class);
    }

    public function externalLinks() {
        return $this->hasMany(NewsExternalLink::class);
    }

    public function images() {
        return $this->hasMany(NewsImage::class);
    }
}
