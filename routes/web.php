<?php

use App\Http\Controllers\Categoria\categoriaController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\Inventario\inventarioController as InventarioInventarioController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Persona\personasController;
use App\Http\Controllers\Procutos\productosController as ProcutosProductosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\Proveedor\ProveedorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Rol\rolController;
use App\Http\Controllers\Usuarios\usuariosController;
use App\Http\Controllers\Ventas\ventasController;
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
    return view('dashboard.index');
})->name("welcome")->middleware("auth");



Route::get("/login", [loginController::class, "index"])->name("login.index");

Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register-login", [RegisterController::class, "store"])->name("register.store");


Route::post("/login-w", [loginController::class, "store"])->name("login.store");
Route::get("/logout", [loginController::class, "destroy"])->name("logout.store");



Route::middleware(['auth'])->group(function () {
    Route::resource('/productos', ProcutosProductosController::class)->parameters(['productos '=> 'producto' ]);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::resource('/usuarios', usuariosController::class)->parameters(['usuarios '=> 'usuario' ]);

    Route::resource('/categorias', categoriaController::class)->parameters(['categorias '=> 'categoria' ]);

    Route::resource('/inventario', InventarioInventarioController::class)->parameters(['inventario '=> 'inventario' ]);

    Route::resource('/proveedor', ProveedorController::class)->parameters(['proveedor '=> 'proveedor' ]);

    Route::resource('/rol', rolController::class)->parameters(['rol'=> 'rol' ]);

    Route::resource('/persona', personasController::class)->parameters(['persona'=> 'persona']);

    Route::resource('/ventas', ventasController::class)->parameters(['ventas'=> 'venta' ]);

    Route::get('/panel_de_control', [PanelController::class, 'index'])->name('panel.index');





});
