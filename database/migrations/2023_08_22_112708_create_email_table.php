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
        Schema::create('email', function (Blueprint $table) {
            $table->id();
            $table->string('servidor', 50)->nullable();
            $table->string('porta', 50)->nullable();
            $table->string('seguranca', 50)->nullable();
            $table->string('usuario', 50)->nullable();
            $table->string('senha', 50)->nullable();
            $table->string('assunto', 60)->nullable();
            $table->text('mensagem')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email');
    }
};
