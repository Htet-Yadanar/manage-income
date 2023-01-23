<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\WishListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [AuthController::class, 'login']);

    Route::post('save-income', [IncomeController::class, 'save_income']); 
    Route::post('update-income', [IncomeController::class, 'update_income']); 
    Route::post('save-wish-list', [WishListController::class, 'wish_list']); 
    Route::post('delete-wish-list', [WishListController::class, 'delete_wish_list']); 
    
    Route::post('edit-wish-list', [WishListController::class, 'edit_wish_list']); 
    Route::post('update-wish-list', [WishListController::class, 'update_wish_list']); 
    
    Route::get('wish-list', [WishListController::class, 'lists']); 


