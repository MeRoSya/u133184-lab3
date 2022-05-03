<?php

namespace App\Domain\Customers\Actions;

use App\Domain\Customers\Models\Customer;

class GetCustomersAction
{
    public function execute($include): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Customer::query()->paginate(10);
    }
}
