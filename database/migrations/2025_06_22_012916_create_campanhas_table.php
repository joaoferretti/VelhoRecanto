<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->enum('tipo_objetivo', ['monetario', 'alcance', 'doacoes', 'voluntarios'])->nullable();
            $table->decimal('objetivo', 12, 2)->default(0);
            $table->string('cor', 7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
