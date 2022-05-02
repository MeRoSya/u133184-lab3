<?php

namespace Database\Seeders;

use App\Domain\Addresses\Models\Address;
use App\Domain\Customers\Models\Customer;
use App\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $namespace = 'Database\\Factories\\';

            $modelName = Str::afterLast($modelName, '\\');

            return $namespace . $modelName . 'Factory';
        });

        Customer::factory(100)->create()
            ->each(function ($customer) {
                $addresses = Address::factory(rand(1, 4))->make();

                $orders = Order::factory(rand(1, 100))->make();

                foreach ($addresses as $address)
                    $customer->addresses()->save($address);

                foreach ($orders as $order) {
                    $addresses[rand(0, $addresses->count() - 1)]->orders()->save($order);
                    $customer->orders()->save($order);
                }
            });
    }
}
