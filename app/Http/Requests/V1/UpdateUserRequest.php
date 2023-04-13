<?php

namespace App\Http\Requests\V1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['sometimes', 'email', 'unique:users'],
            'name' => ['sometimes', 'string'],
            'birthday' => ['sometimes', 'date'],
            'gender' => ['sometimes'],
            'subscribed' => ['sometimes', 'boolean'],
            'topicsOfDisinterest' => ['sometimes', 'array'],
            'theme' => ['sometimes'],
            'notifications_set' => ['sometimes', 'boolean'],
            'localisation_set' => ['sometimes', 'boolean'],
            'explanation_shown' => ['sometimes', 'boolean'],
            'data_shown' => ['sometimes', 'boolean'],
            'bonus_info_shown' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation() {
        $this->birthday && $this->merge(['birthday' => Carbon::parse($this->birthday)->format('Y-m-d')]);
        $this->notificationsSet && $this->merge(['notifications_set' => $this->notificationsSet]);
        $this->localisationSet && $this->merge(['localisation_set' => $this->localisationSet]);
        $this->explanationShown && $this->merge(['explanation_shown' => $this->explanationShown]);
        $this->dataShown && $this->merge(['data_shown' => $this->dataShown]);
        $this->bonusInfoShown && $this->merge(['bonus_info_shown' => $this->bonusInfoShown]);
    }
}
