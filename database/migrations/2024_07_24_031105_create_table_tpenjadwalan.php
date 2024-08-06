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
        Schema::create('Tpenjadwalan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diklat_id');
            $table->foreign('diklat_id')->references('id')->on('MDiklat');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Tpenjadwalan');
    }
};
