<?php

use App\Http\Controllers\API\CustomerController;
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

Route::middleware( 'auth:api' )->get( '/user', function ( Request $request ) {
    return $request->user();
} );

Route::get( 'customers', [ CustomerController::class, 'index' ] );
Route::post( 'customer', [ CustomerController::class, 'store' ] );
Route::get( 'customer/{id}/edit', [ CustomerController::class, 'edit' ] );
Route::put( 'customer/{id}', [ CustomerController::class, 'update' ] );
Route::delete( 'customer/{id}', [ CustomerController::class, 'delete' ] );

Route::post( 'customer/upload', [ CustomerController::class, 'upload' ] );
