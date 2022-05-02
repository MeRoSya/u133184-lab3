<?php

namespace Database\Factories;

use App\Domain\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => 0,
            'address_id' => 0,
            'creation_time' => $this->faker->dateTime(),
            'deliver_before' => $this->faker->dateTime(),
            'cost' => $this->faker->numberBetween(1),
            'payed' => $this->faker->boolean(),
            'delivered' => $this->faker->boolean()
        ];
    }
}
