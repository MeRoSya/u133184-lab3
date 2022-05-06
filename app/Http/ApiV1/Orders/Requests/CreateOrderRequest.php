<?php

namespace App\Http\ApiV1\Orders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address_id' => ['required'],
            'customer_id' => ['required'],
            'creation_time' => ['date', 'required'],
            'deliver_before' => ['date', 'required'],
            'cost' => ['integer', 'min:1', 'required'],
            'payed' => ['boolean', 'required'],
            'delivered' => ['boolean', 'required']
        ];
    }
}
