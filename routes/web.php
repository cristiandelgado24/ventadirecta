<?php

use App\Http\Controllers\Transaction\GetCompletedController;
use App\Http\Controllers\Transaction\ResultController;
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
    return view('transaction.form');
});

Route::get('/transaction-result/{id}', ResultController::class)->name('transaction.result');
Route::get('/get-completed-transactions', GetCompletedController::class)->name('transaction.get-completed');

Route::get('/prueba', function() {
    try {
        DB::connection()->getPDO();
        dump('Conexión establecida. Base de datos: ' . DB::connection()->getDatabaseName());
    } catch (\Exception $e) {
        dump($e->getMessage());
    }
});
