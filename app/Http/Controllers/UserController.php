<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

	public function usersWithMostExpensiveOrder(): \Illuminate\Http\JsonResponse
	{
		/*
		$usersWithMostExpensiveOrder = User::select('users.id', 'users.name', 'users.email')
			->selectSub(function ($query) {
				$query->select('total_amount')
					->from('orders')
					->whereColumn('user_id', 'users.id')
					->orderByDesc('total_amount')
					->limit(1);
			}, 'most_expensive_order')
			->get();
		*/

		$usersWithMostExpensiveOrder = User::select('users.id', 'users.name', 'users.email', DB::raw('MAX(total_amount) AS most_expensive_order') )
			->join('orders', function(JoinClause $join) {
				$join->on('orders.user_id', '=', 'users.id');
			})
			->groupBy('users.id')
			->orderBy('most_expensive_order', 'DESC')
			->get();

		return response()->json($usersWithMostExpensiveOrder);
	}

	public function usersWhoPurchasedAllProducts(): \Illuminate\Http\JsonResponse
	{
		$usersWhoPurchasedAllProducts = User::select('users.id', 'users.name', 'users.email')
			->join('orders', 'users.id', '=', 'orders.user_id')
			->groupBy('users.id')
			->havingRaw('COUNT(DISTINCT orders.product_id) = ?', [Product::count()])
			->get();

		return response()->json($usersWhoPurchasedAllProducts);
	}

	public function userWithHighestTotalSales(): \Illuminate\Http\JsonResponse
	{
		/*
		$usersWhoPurchasedAllProducts = Order::select('user_id', DB::raw('SUM(total_amount) AS amount_sum'))
			->with(['user' => function ($query) { $query->select(['id', 'name', 'email']); }])
			->groupBy('user_id')
			->orderBy('amount_sum', 'desc')
			->first();
		*/

		$usersWhoPurchasedAllProducts = Order::select('users.id', 'users.name', 'users.email', DB::raw('SUM(total_amount) AS total_sales') )
			->join('users', function(JoinClause $join) {
				$join->on('orders.user_id', '=', 'users.id');
			})
			->groupBy('users.id')
			->orderBy('total_sales', 'DESC')
			->first();

		return response()->json($usersWhoPurchasedAllProducts);
	}

}
