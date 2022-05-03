<?php

namespace App\Http\ApiV1\Addresses\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['integer'],
            'customer_id' => ['present'],
            'city' => ['string'],
            'street' => ['string'],
            'building' => ['string'],
            'floor' => ['integer'],
            'flat' => ['string']
        ];
    }
}
