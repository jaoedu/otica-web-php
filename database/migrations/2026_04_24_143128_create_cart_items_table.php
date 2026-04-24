<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de itens do carrinho
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // 🔗 Relacionamento com usuário
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // 🔗 Relacionamento com produto
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // 📦 Quantidade do produto no carrinho
            $table->integer('quantity')->default(1);

            // 🔥 Evita duplicação do mesmo produto no carrinho do mesmo usuário
            $table->unique(['user_id', 'product_id']);

            $table->timestamps();
        });
    }

    /**
     * Remove a tabela
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
