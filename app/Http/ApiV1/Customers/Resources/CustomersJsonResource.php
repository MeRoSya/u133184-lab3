<?php

namespace App\Http\ApiV1\Customers\Resources;

use App\Http\ApiV1\Common\Resources\CommonJsonResource;

class CustomersJsonResource extends CommonJsonResource
{
    public function toArray($request)
    {
        if(empty($this['errors'])) {
            $toReturn = parent::toArray($request);

            $data = $this['data'];
            $customers = [];

            foreach ($data->items() as $customer)
                $customers[] = new CustomerJsonResource($customer);

            $toReturn['data'] = $customers;
            $toReturn['meta'] = [];
            $toReturn['meta']['pagination'] = [];
            $toReturn['meta']['pagination']['next_page_url'] = $data->nextPageUrl();
            $toReturn['meta']['pagination']['path'] = $data->path();
            $toReturn['meta']['pagination']['prev_page_url'] = $data->previousPageUrl();
            $toReturn['meta']['pagination']['per_page'] = $data->perPage();
            $toReturn['meta']['pagination']['total'] = $data->total();
            $toReturn['meta']['pagination']['current_page'] = $data->currentPage();
        }
        else
        {
            $toReturn['data'] = null;
            $toReturn['errors'] = $this['errors'];
        }

        return $toReturn;
    }
}
