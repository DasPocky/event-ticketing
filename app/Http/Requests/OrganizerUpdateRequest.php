<?php

namespace App\Http\Requests;

use App\Models\Organizer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizerUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'zip' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(Organizer::class)->ignore($this->user()->organizer->id)],
            'phone' => ['string', 'max:255'],
            'website' => ['string', 'max:255'],
        ];
    }
}
