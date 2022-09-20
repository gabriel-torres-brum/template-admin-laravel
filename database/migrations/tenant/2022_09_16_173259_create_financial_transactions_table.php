<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('type'); // 1 - Entrada, 2 - Saída
            $table->string('description');
            $table->string('value');
            $table->string('payment_method')->nullable();
            $table->string('invoice')->nullable(); // imagem
            $table->integer('status')->nullable(); // 1 - Em aberto, 2 - Pago, 3 - Anulado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
};
