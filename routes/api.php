<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
	Route::get('/users-with-most-expensive-order', [UserController::Class, 'usersWithMostExpensiveOrder']);
	Route::get('/users-who-purchased-all-products', [UserController::Class, 'usersWhoPurchasedAllProducts']);
	Route::get('/user-with-highest-total-sales', [UserController::Class, 'userWithHighestTotalSales']);
});

