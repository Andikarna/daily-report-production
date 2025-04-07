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
        Schema::create('report_approval', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('divisi_id');
            $table->bigInteger('report_id');
            $table->bigInteger('report_detail_id');
            $table->bigInteger('approval_id');
            $table->string('status');
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
