<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = Order::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'user_id' => function () {
				return \App\Models\User::factory()->create()->id;
			},
			'product_id' => function () {
				return \App\Models\Product::factory()->create()->id;
			},
			'quantity' => $this->faker->randomNumber(),
			'total_amount' => $this->faker->randomFloat(2, 10, 500),
		];
	}
}
