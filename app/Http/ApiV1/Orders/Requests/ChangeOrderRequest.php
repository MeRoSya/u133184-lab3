<?php

namespace App\Http\ApiV1\Orders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'creation_time' => ['date'],
            'deliver_before' => ['date'],
            'cost' => ['integer', 'min:1'],
            'payed' => ['boolean'],
            'delivered' => ['boolean']
        ];
    }
}
