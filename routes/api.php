<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;

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

Route::post('/login', [UsersController::class, 'login']);

Route::group(
    ['middleware' => ['auth:sanctum']], function () {
        Route::namespace ('Author')->prefix('author')->group(
            function () {
                    Route::get('/show/{id}', [AuthorsController::class, 'show']);
                    Route::get('/list', [AuthorsController::class, 'list']);
                    Route::post('/', [AuthorsController::class, 'create']);
                    Route::put('/{id}', [AuthorsController::class, 'update']);
                    Route::delete('/{id}', [AuthorsController::class, 'delete']);
                }
        );

        Route::namespace ('Book')->prefix('book')->group(
            function () {
                    Route::get('/show/{id}', [BooksController::class, 'show']);
                    Route::get('/list', [BooksController::class, 'list']);
                    Route::post('/', [BooksController::class, 'create']);
                    Route::put('/{id}', [BooksController::class, 'update']);
                    Route::delete('/{id}', [BooksController::class, 'delete']);
                }
        );
    }
);
