<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'deskripsi' => fake()->sentence(),
            'foto' => null,
            'is_default' => false,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            $product->prices()->create([
                'harga_dalam_rupiah' => fake()->randomElement([
                    4000,
                    9000,
                ]),
            ]);
        });
    }
}