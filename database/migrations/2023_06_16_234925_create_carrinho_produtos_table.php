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
        Schema::create('carrinho_produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('qtd');
            $table->unsignedBigInteger('carrinho_id');
            $table->unsignedBigInteger('produto_id');

            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('carrinho_id')->references('id')->on('carrinhos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho_produtos', function (Blueprint $table) {
            $table->dropForeign('carrinho_produtos_carrinho_id_foreign');
            $table->dropForeign('carrinho_produtos_produto_id_foreign');
        });

        Schema::dropIfExists('carrinho_produtos');
    }
};
