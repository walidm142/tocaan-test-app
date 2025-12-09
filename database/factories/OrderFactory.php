<?php

namespace Database\Factories;

use App\Api\V1\Orders\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // or use User::factory() if you want to create a user
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'status' => 'pending',
            'total_price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}