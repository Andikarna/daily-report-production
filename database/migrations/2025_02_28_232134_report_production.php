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
        Schema::create('report_productions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('divisi_id');
            $table->bigInteger('leader_id');
            $table->timestamp('date_production');
            $table->bigInteger('operator_id');
            $table->string('name');
            $table->string('shift');
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
