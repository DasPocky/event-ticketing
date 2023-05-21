<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tickets.*' => 'integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'tickets.*.integer' => 'Die Anzahl muss eine Ganzzahl sein',
            'tickets.*.min' => 'Die Anzahl kann nicht kleiner als 0 sein',
        ];
    }
}
