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
            $table->string('name');
            $table->dateTime('date_production');
            $table->char('shift');
            $table->string('ip');
            $table->string('no_lot');
            $table->integer('ok');
            $table->integer('ng');
            $table->integer('total');
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
