<?php

use App\Http\Controllers\AbilityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('', function () {
    return response()->json(['status' => 'API_ONLINE']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/me", [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::prefix('abilities')->group(function () {
        Route::get('/', [AbilityController::class, 'index']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware('abilities:user_list_all');
        Route::post('/', [UserController::class, 'store'])->middleware('abilities:user_create');
        Route::put('/{id}', [UserController::class, 'update'])->middleware('abilities:user_edit');
        Route::get('/{id}', [UserController::class, 'show'])->middleware('abilities:user_by_id');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('abilities:user_delete');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->middleware('abilities:list_perfil');
        Route::post('/', [ProfileController::class, 'store'])->middleware('abilities:cad_perfil');
        Route::put('/{id}', [ProfileController::class, 'update'])->middleware('abilities:user_edit');
        Route::delete('/{id}', [ProfileController::class, 'destroy'])->middleware('abilities:del_perfil');

        Route::get('/{id}/abilities', [ProfileController::class, 'getAbilities'])->middleware('abilities:list_ability_perfil');
        Route::post('/{id}/addAbilities', [ProfileController::class, 'addPermissions']);
    });
});




    // Route::get("/me", [AuthController::class, 'me']);
    // Route::post('/logout', [AuthController::class, 'logout']);


    // Route::prefix('abilities')->group(function () {
    //     Route::get('/', [AbilityController::class, 'index']);
    // });

    // Route::prefix('users')->group(function () {
    //     Route::get('/', [UserController::class, 'index']);
    //     Route::post('/', [UserController::class, 'store']);
    //     Route::put('/{id}', [UserController::class, 'update']);
    //     Route::get('/{id}', [UserController::class, 'show']);
    //     Route::delete('/{id}', [UserController::class, 'destroy']);
    // });

    // Route::prefix('profiles')->group(function () {
    //     Route::get('/', [ProfileController::class, 'index']);
    //     Route::post('/', [ProfileController::class, 'store']);
    //     Route::put('/{id}', [ProfileController::class, 'update']);
    //     Route::delete('/{id}', [ProfileController::class, 'destroy']);

    //     Route::get('/{id}/abilities', [ProfileController::class, 'getAbilities']);
    //     Route::post('/{id}/addAbilities', [ProfileController::class, 'addPermissions']);
    // });
