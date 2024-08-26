<?php

use App\Http\Controllers\API\apiproductsController;
use App\Http\Controllers\API\apisectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return 1;
});

// Route::middleware('auth:sanctum')->group(function(){


// Sections
Route::prefix('sections')->group(function(){
    Route::get('/',[apisectionController::class,'index']);
    Route::post('/store', [apisectionController::class, 'store']);
    Route::get('/show/{id}', [apisectionController::class, 'show']);
    Route::put('/update', [apisectionController::class, 'update']);
    Route::delete('destroy/{id}', [apisectionController::class, 'destroy']);
});  ###########  End Section

// ##############################################
// ################ Start Products #############

    Route::prefix('products')->group(function(){
        Route::get('/', [apiproductsController::class, 'index']);
        Route::post('/store', [apiproductsController::class, 'store']);
        Route::get('/show/{id}', [apiproductsController::class, 'show']);
        Route::put('/update', [apiproductsController::class, 'update']);
        Route::delete('/destroy/{id}', [apiproductsController::class, 'destroy']);
    });
// });





Auth::routes();



