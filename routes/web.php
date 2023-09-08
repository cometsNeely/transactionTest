<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'create']);
Route::get('/auth', [AuthController::class, 'authorization']);
Route::post('register', [AuthController::class, 'store']);
Route::post('auth', [AuthController::class, 'login']);
Route::get('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/transaction', [TransactionController::class, 'show'])->name('transaction');
Route::post('/buy', [TransactionController::class, 'buy'])->name('buy');
Route::post('/sale', [TransactionController::class, 'sale'])->name('sale');

