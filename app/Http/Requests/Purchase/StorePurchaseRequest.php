<?php

namespace App\Http\Requests\Purchase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $tickets = $this->input('tickets');
            $totalTickets = array_sum($tickets);

            if ($totalTickets == 0) {
                $validator->errors()->add('tickets', 'Bitte wählen Sie mindestens ein Ticket aus.');
            }
        });
    }
}
