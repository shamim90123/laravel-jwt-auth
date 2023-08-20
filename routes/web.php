<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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
    return view('welcome');
});

Route::middleware(['auth.user'])->group(function () {
    // Your protected routes go here
    Route::get('token-verification', function () {
        Log::info('Token Verification route executed');
        return response([
            'success' => true
        ]);
    });

});
