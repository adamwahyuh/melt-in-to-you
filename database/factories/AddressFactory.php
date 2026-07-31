<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'rt' => fake()->numberBetween(1, 20),
            'rw' => fake()->numberBetween(1, 20),

            'kota' => fake()->city(),
            'kecamatan' => fake()->citySuffix(),
            'kelurahan' => fake()->streetName(),

            'alamat' => fake()->streetAddress(),
            'kode_pos' => fake()->postcode(),

            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn () => [
            'is_active' => false,
        ]);
    }
}