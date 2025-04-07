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
        Schema::create('daily_achievements', function (Blueprint $table) {
            $table->id();
            $table->integer('production_id');
            $table->integer('divisi_id');
            $table->integer('operator_id');
            $table->dateTime('date_production');
            $table->string('achievement');
            $table->timestamps();
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
