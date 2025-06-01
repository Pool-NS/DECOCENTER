<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Necesario para el login
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;

// Ruta principal de la aplicación
Route::get('/', function () {
    return view('home');
})->name('home');

// Rutas para productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::resource('productos', ProductoController::class)->middleware('auth'); // Utiliza resource para CRUD completo

// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register'); // Ruta para mostrar el formulario de registro
Route::post('/register', [RegisteredUserController::class, 'store']); // Ruta para crear el usuario

// Dashboard para usuarios autenticados
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) // Asegúrate de que el usuario esté autenticado y verificado
    ->name('dashboard');

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Ruta de logout de Laravel (no necesitas agregarla manualmente)
Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Ruta para el dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('/historial-inventario', [InventoryLogController::class, 'index'])->name('inventory.logs');

Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');


// Cargar las rutas de autenticación generadas por Breeze
require __DIR__.'/auth.php';

// Rutas para ventas
Route::get('/productos/{id}/vender', [VentaController::class, 'formulario'])->name('productos.vender.form');
Route::post('/productos/{id}/vender', [VentaController::class, 'procesar'])->name('productos.vender.procesar');

// Rutas para reportes
Route::get('/reportes/ventas-por-mes', [ReporteController::class, 'ventasPorMes'])->name('reportes.ventas_por_mes');