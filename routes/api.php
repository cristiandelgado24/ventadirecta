<?php

use App\Http\Controllers\Form\GetDocumentTypesController;
use App\Http\Controllers\SINU\GetFormNumberController;
use App\Http\Controllers\Transaction\SendEmailController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('v1/form/document-types', GetDocumentTypesController::class)->name('form.get-document-types');
Route::post('v1/transaction/send-email', SendEmailController::class)->name('transaction.send-email');
Route::get('v1/SINU/form-number/{document}', GetFormNumberController::class)->name('SINU.get-number');
