<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('transaction', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction-index');
Route::get('transaction/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transaction-show');
Route::post('transaction', [App\Http\Controllers\TransactionController::class, 'store'])->name('transaction-create');
Route::patch('transaction/{id}', [App\Http\Controllers\TransactionController::class, 'update'])->name('transaction-update');
Route::delete('transaction/{id}', [App\Http\Controllers\TransactionController::class, 'destroy'])->name('transaction-destroy');
