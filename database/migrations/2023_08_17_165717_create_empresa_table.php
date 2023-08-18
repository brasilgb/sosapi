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
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('empresa', 50)->nullable();
            $table->string('razao', 50)->nullable();
            $table->string('cnpj', 50)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('endereco', 50)->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('uf', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('cep', 50)->nullable();
            $table->string('telefone', 50)->nullable();
            $table->string('site', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa');
    }
};