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
        Schema::create('financial_reports_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('financial_transaction_id')->constrained();
            $table->foreignUuid('financial_report_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_reports_financial_transactions');
    }
};
