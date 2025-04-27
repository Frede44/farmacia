<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get("/login", [loginController::class, "index"])->name("login.index");



Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register-login", [RegisterController::class, "store"])->name("register.store");