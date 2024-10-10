<?php

use App\Http\Controllers\Form\GetDocumentTypeController;
use App\Http\Controllers\Form\GetDocumentTypesController;
use App\Http\Controllers\SINU\GetFormNumberController;
use App\Http\Controllers\Transaction\CompleteOneController;
use App\Http\Controllers\Transaction\GenerateRespuestaPagoController;
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
Route::get('/complete-one-transaction', CompleteOneController::class)->name('transaction.complete-one');
Route::get('/generate-respuesta-pago/{id}', GenerateRespuestaPagoController::class)->name('transaction.generate-respuesta-pago');
Route::get('/get-form-number/{document}', GetFormNumberController::class)->name('SINU.get-form-number');



Route::get('/prueba', function() {
    try {
        DB::connection()->getPDO();
        dump('Conexión establecida. Base de datos: ' . DB::connection()->getDatabaseName());
    } catch (\Exception $e) {
        dump($e->getMessage());
    }
});

