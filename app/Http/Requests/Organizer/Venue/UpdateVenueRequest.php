<?php

namespace App\Http\Requests\Organizer\Venue;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVenueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'country' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'contact_name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
            'notes' => 'nullable'
        ];
    }
}
