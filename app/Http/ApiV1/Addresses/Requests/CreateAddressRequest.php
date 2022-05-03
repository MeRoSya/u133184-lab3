<?php

namespace App\Http\ApiV1\Addresses\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer', 'required'],
            'customer_id' => ['present', 'required'],
            'city' => ['string', 'required'],
            'street' => ['string', 'required'],
            'building' => ['string', 'required'],
            'floor' => ['integer', 'required'],
            'flat' => ['string', 'required']
        ];
    }
}
