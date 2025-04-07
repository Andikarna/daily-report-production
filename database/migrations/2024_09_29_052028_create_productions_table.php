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
        Schema::create('production', function (Blueprint $table) {
            $table->id();
            $table->integer('divisi_id');
            $table->integer('leader_id');
            $table->integer('operator_id');
            $table->datetime('date_production');
            $table->string('ip');
            $table->string('ok');
            $table->string('percent_of_ok');
            $table->string('ng');
            $table->string('percent_of_ng');
            $table->text('total');
            $table->text('achievments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productions');
    }
};
