<?php

namespace Database\Factories;

use App\Domain\Addresses\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'building' => $this->faker->buildingNumber(),
            'floor' => $this->faker->numberBetween(-100, 100),
            'flat' => Str::random(4)
        ];
    }
}
