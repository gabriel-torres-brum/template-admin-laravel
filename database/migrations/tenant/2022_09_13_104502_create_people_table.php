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
        Schema::create('people', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('gender');
            $table->date('birthday');
            $table->string('marital_status');
            $table->string('birthplace');
            $table->boolean('is_baptized')->default(false);
            $table->boolean('is_tither')->default(false);
            $table->boolean('is_in_discipline')->default(false);
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('baptism_date')->nullable();
            $table->date('receipt_date')->nullable();
            $table->date('affiliation_date')->nullable();
            $table->string('church_from')->nullable();
            $table->string('picture')->nullable(); // image

            $table->foreignUuid('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid('ecclesiastical_role_id')->nullable()->constrained()->nullOnDelete();

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
        Schema::dropIfExists('people');
    }
};
