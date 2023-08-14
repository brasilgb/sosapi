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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->text('codbarra')->nullable();
            $table->string('descricao');
            $table->tinyInteger('movimento');
            $table->double('valentrada');
            $table->double('valsaida');
            $table->tinyInteger('unidade');
            $table->string('qtdmaxima');
            $table->string('qtdminima');
            $table->tinyInteger('tipo');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
