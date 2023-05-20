<?php

namespace App\Http\Requests\Organizer\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sub_category_id' => 'required',
            'venue_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'entry_datetime' => 'nullable',
            'start_datetime' => 'required',
            'end_datetime' => 'nullable',
            'status' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'required'
        ];
    }
}
