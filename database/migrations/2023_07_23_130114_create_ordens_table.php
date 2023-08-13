<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('equipamento', 40);
            $table->string('modelo', 50)->nullable();
            $table->string('senha', 50);
            $table->text('defeito');
            $table->string('estado', 100);
            $table->text('acessorios')->nullable();
            $table->string('orcamento', 50)->nullable();
            $table->text('descorcamento')->nullable();
            $table->text('detalhes')->nullable(); // servicos executados
            $table->text('pecas')->nullable();
            $table->decimal('valpecas', 6, 2)->nullable();
            $table->decimal('valservico', 6, 2)->nullable();
            $table->decimal('custo', 6, 2)->nullable();
            $table->string('previsao')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('envioemail')->nullable();
            $table->dateTime('dtentrega')->nullable();
            $table->string('tecnico', 50)->nullable();
            $table->text('observacoes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
