<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Course',
            'price' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
