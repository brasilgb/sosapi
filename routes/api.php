<?php

use App\Http\Controllers\Api\V1\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\OrdemController;
use App\Http\Controllers\Api\V1\ProdutoController;
use App\Http\Controllers\Api\V1\AgendaController;
use App\Http\Controllers\AuthController;
use App\Models\Produto;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('v1')->group(function () {
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/invoices', InvoiceController::class);

    Route::apiResource('/clientes', ClienteController::class);
    Route::get('/allclientes', [ClienteController::class, 'allclientes']);

    Route::apiResource('/ordens', OrdemController::class)->parameters([
        'ordens' => 'ordem'
    ]);
    Route::get('/allordens', [OrdemController::class, 'allordens']);
    
    Route::apiResource('/produtos', ProdutoController::class);
    Route::get('/allprodutos', [ProdutoController::class, 'allprodutos']);

    Route::apiResource('/agendas', AgendaController::class);
    Route::get('/allagendas', [AgendaController::class, 'allagendas']);
    
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum', 'ability:admin-access']);
});
