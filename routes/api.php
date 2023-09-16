<?php

use App\Http\Controllers\Api\V1\ClienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\OrdemController;
use App\Http\Controllers\Api\V1\ProdutoController;
use App\Http\Controllers\Api\V1\AgendaController;
use App\Http\Controllers\Api\V1\EmailController;
use App\Http\Controllers\Api\V1\MensagemController;
use App\Http\Controllers\Api\V1\EmpresaController;
use App\Http\Controllers\Api\V1\ImagemController;
use App\Http\Controllers\Api\V1\ImpressaoController;
use App\Http\Controllers\AuthController;


Route::prefix('v1')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('/users', UserController::class);
        Route::get('/allusers', [UserController::class, 'allusers']);

        Route::apiResource('/clientes', ClienteController::class);
        Route::get('/allclientes', [ClienteController::class, 'allclientes']);

        Route::apiResource('/ordens', OrdemController::class)->parameters([
            'ordens' => 'ordem'
        ]);
        Route::get('/allordens', [OrdemController::class, 'allordens']);
        Route::get('/printtermo/{id}', [OrdemController::class, 'printTermo']);

        Route::apiResource('/produtos', ProdutoController::class);
        Route::get('/allprodutos', [ProdutoController::class, 'allprodutos']);

        Route::apiResource('/agendas', AgendaController::class);
        Route::get('/allagendas', [AgendaController::class, 'allagendas']);

        Route::apiResource('/mensagens', MensagemController::class)->parameters([
            'mensagens' => 'mensagem'
        ]);
        Route::get('/allmensagens', [AgendaController::class, 'allmensagens']);

        Route::apiResource('/empresa', EmpresaController::class);
        Route::post('/empresa/upload/{empresa}', [EmpresaController::class, 'upload'])->name('empresa.upload');

        Route::apiResource('/email', EmailController::class);

        Route::apiResource('/impressoes', ImpressaoController::class)->parameters([
            'impressoes' => 'impressao'
        ]);

        Route::apiResource('/imagens', ImagemController::class)->parameters([
            'imagens' => 'imagem'
        ]);
        Route::post('/logout', [AuthController::class, 'logout']);

    });
    Route::get('/logotipo', [EmpresaController::class, 'logotipo']);
    Route::post('/login', [AuthController::class, 'login']);
    
});
