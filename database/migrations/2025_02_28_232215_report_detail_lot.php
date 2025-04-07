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
        Schema::create('report_detail_lot', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id');
            $table->bigInteger('report_detail_id');
            $table->string('no_lot');
            $table->string('ok');
            $table->string('time');
            $table->string('ng');
            $table->string('total');
            $table->text('description');
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
