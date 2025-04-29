<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
})->name("welcome")->middleware("auth");



Route::get("/login", [loginController::class, "index"])->name("login.index");

Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register-login", [RegisterController::class, "store"])->name("register.store");


Route::post("/login-w", [loginController::class, "store"])->name("login.store");
Route::get("/logout", [loginController::class, "destroy"])->name("logout.store");



Route::middleware(['auth'])->group(function () {
    Route::get('/productos', [productosController::class, "index"])->name('productos.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    //Productos
    Route::get('/dashboard/productos', [ProductosController::class, 'index'])->name('productos');
    Route::get('/dashboard/productos/create', [ProductosController::class, 'create'])->name('productos.create');
    //Categorias
    Route::get('/dashboard/categorias', [CategoriasController::class, 'index'])->name('categorias');
    //Inventario
    Route::get('/dashboard/inventario', [InventarioController::class, 'index'])->name('inventario');

});
