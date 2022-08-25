<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TrailerController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\CollectAddressController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocumentController;

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

Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    // Single Function Routes
    Route::get('nav', [NavController::class, 'index2']);
    Route::patch('pwChange', [UserController::class, 'changePassword']);
    Route::get('offer/highestNumber', [OfferController::class, 'getHighestNumber']);
    Route::get('reservation/highestNumber', [ReservationController::class, 'getHighestNumber']);
    Route::get('contract/highestNumber', [ContractController::class, 'getHighestNumber']);
    Route::get('document/{id}', [DocumentController::class, 'downloadPDF']);
    Route::patch('document/{id}', [DocumentController::class, 'forwardDocument']);

    // Full CRUD Routes
    Route::apiResource('user', UserController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('trailer', TrailerController::class);
    Route::apiResource('equipment', EquipmentController::class);
    Route::apiResource('options', OptionController::class);
    Route::apiResource('collectAddress', CollectAddressController::class);
    Route::apiResource('offer', OfferController::class);
    Route::apiResource('reservation', ReservationController::class);
    Route::apiResource('contract', ContractController::class);
});
