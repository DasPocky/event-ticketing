<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'address' => ['string', 'max:255'],
            'zip' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'phone' => ['string', 'max:255'],
        ];
    }
}
