<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
	    Order::factory(40)->create();

	    $user = User::find(1);
	    $products = Product::all();
	    foreach ($products as $product) {
		    $quantity = rand(1, 5);
		    $totalAmount = $product->price * $quantity;
		    Order::factory()->create([
			    'user_id' => $user->id,
			    'product_id' => $product->id,
			    'quantity' => $quantity,
			    'total_amount' => $totalAmount,
		    ]);
	    }
    }
}
