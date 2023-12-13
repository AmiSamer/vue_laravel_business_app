<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\HomeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[App\Http\Controllers\Auth\RegisterController::class,'register']);
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login']);
Route::post('/logout',[App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::post('/save_sale',[App\Http\Controllers\SaleController::class, 'save_sale']);
Route::get('/show_all_sale',[App\Http\Controllers\SaleController::class, 'show_all_sale']);
Route::get('/show_single_sale/{id}',[App\Http\Controllers\SaleController::class, 'show_single_sale']);


Route::post('/date_wise_report',[App\Http\Controllers\SaleController::class, 'date_wise_report']);
Route::post('/update_sale',[App\Http\Controllers\SaleController::class, 'update_sale']);

Route::get('/delete_sale/{id}',[App\Http\Controllers\SaleController::class, 'delete_sale']);

Route::post('/user_profile_update',[App\Http\Controllers\SaleController::class, 'profile_update']);

Route::get('/total_today',[App\Http\Controllers\SaleController::class, 'total_today']);
Route::get('/total_year',[App\Http\Controllers\SaleController::class, 'total_year']);

Route::get('/today_all_sale',[App\Http\Controllers\SaleController::class, 'today_all_sale']);
Route::get('/all_user',[App\Http\Controllers\HomeController::class, 'all_user']);
Route::get('/change_status/{id}',[App\Http\Controllers\HomeController::class, 'change_status']);





