<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'name' => $this->name,
            'birthday' => Carbon::parse($this->birthday)->toIso8601String(),
            'gender' => $this->gender,
            'topicsOfDisinterest' => NewsCategoryResource::collection($this->whenLoaded('topicsOfDisinterest')),
            'subscribed' => $this->subscribed,
            'theme' => $this->theme,
            'notificationsSet' => $this->notifications_set,
            'localisationSet' => $this->localisation_set,
            'explanationShown' => $this->explanation_shown,
            'dataShown' => $this->data_shown,
            'bonusInfoShown' => $this->bonus_info_shown,
        ];
    }
}
