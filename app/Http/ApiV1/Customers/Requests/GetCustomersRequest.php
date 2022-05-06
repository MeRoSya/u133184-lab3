<?php

namespace App\Http\ApiV1\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetCustomersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'include' => ['string', 'regex:(addresses|orders)']
        ];
    }
}
