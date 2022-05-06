<?php

namespace App\Http\ApiV1\Common\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
            'meta' => ['trace' => $this->getTrace()]
        ];
    }
}
