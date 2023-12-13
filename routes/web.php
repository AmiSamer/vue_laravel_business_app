<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginRegisterController;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/{pathMatch}',function(){
    return view('app');
})->where('pathMatch',".*");


// Auth::routes();


// Route::post('/login',[App\Http\Controllers\Auth\LoginRegisterController::class,'login']);
// Route::post('/logout', [App\Http\Controllers\Auth\LoginRegisterController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
