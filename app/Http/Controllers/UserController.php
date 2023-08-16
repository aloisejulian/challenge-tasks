<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public function usersWithMostExpensiveOrder(): \Illuminate\Http\JsonResponse
	{
		/* We are using the ::with to avoid de N+1. */
		$usersWithMostExpensiveOrder = User::with('most_expensive_order')->get(['id', 'name', 'email']);
		return response()->json($usersWithMostExpensiveOrder);
	}

	public function usersWhoPurchasedAllProducts(): \Illuminate\Http\JsonResponse
	{
		$productCount = Product::count();

		$userIdsWithAllProducts = Order::select('user_id')
			->distinct()
			->groupBy('user_id')
			->havingRaw('COUNT(DISTINCT product_id) = ' . $productCount)
			->pluck('user_id');


		$usersWhoPurchasedAllProducts = User::whereIn('id', $userIdsWithAllProducts)
			->get(['id', 'name', 'email']);

		return response()->json($usersWhoPurchasedAllProducts);
	}

	public function userWithHighestTotalSales(): \Illuminate\Http\JsonResponse
	{

		$usersWhoPurchasedAllProducts = Order::select('user_id', DB::raw('SUM(total_amount) AS amount_sum'))
			->with(['user' => function ($query) { $query->select(['id', 'name', 'email']); }])
			->groupBy('user_id')
			->orderBy('amount_sum', 'desc')
			->first();

		return response()->json($usersWhoPurchasedAllProducts);
	}

}
