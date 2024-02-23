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
        Route::get('/', [UserController::class, 'index'])->middleware('abilities:user_list');
        Route::post('/', [UserController::class, 'store'])->middleware('abilities:user_insert');
        Route::get('/{id}', [UserController::class, 'show'])->middleware('abilities:user_list_by_id');
        Route::put('/{id}', [UserController::class, 'update'])->middleware('abilities:user_edit');
        Route::delete('/{id}', [UserController::class, 'destroy'])->middleware('abilities:user_delete');
        Route::post('/alterarsenha', [UserController::class, 'alterarSenhaUsuario'])->middleware('abilities:user_change_password');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->middleware('abilities:profile_list');
        Route::post('/', [ProfileController::class, 'store'])->middleware('abilities:profile_inset');
        Route::get('/{id}', [ProfileController::class, 'show'])->middleware('abilities:user_list_by_id');
        Route::put('/{id}', [ProfileController::class, 'update'])->middleware('abilities:profile_edit');
        Route::delete('/{id}', [ProfileController::class, 'destroy'])->middleware('abilities:profile_delete');

        Route::get('/abilities/{id}', [ProfileController::class, 'getAbilities'])->middleware('abilities:profile_list_ability');
        Route::post('/addAbilities', [ProfileController::class, 'addPermissions']);
    });
});

