<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Open\OfficialAccountController;

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

Route::namespace('Open')->group(function (){
    Route::get('official-account/receipt', [OfficialAccountController::class, 'check']);
    Route::post('official-account/receipt', [OfficialAccountController::class, 'receipt']);
});
