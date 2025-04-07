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
        Schema::create('master_product_enginering', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('master_id');
            $table->timestamp('date');
            $table->string('ip');
            $table->bigInteger('divisi_id');
            $table->string('result_of_time');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
