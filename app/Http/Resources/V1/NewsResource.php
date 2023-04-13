<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'createdAt' => Carbon::parse($this->created_at)->toIso8601String(),
            'createdBy' => $this->creator->name,
            'title' => $this->title,
            'desc' => $this->desc,
            'imagePath' => $this->image_path,
            'newsCategoryId' => $this->news_category_id,
            'newsCategory' => new NewsCategoryResource($this->whenLoaded('newsCategory')),
            'externalLinks' => NewsExternalLinkResource::collection($this->whenLoaded('externalLinks')),
            'sources' => NewsSourceLinkResource::collection($this->whenLoaded('sourceLinks')),
            'images' => NewsImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
