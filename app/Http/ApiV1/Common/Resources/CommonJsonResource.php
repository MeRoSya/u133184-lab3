<?php

namespace App\Http\ApiV1\Common\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommonJsonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'data' => null,
            'errors' => []
        ];
    }

}
