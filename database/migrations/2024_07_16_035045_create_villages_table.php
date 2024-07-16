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
        Schema::create('MVillages', function (Blueprint $table) {
            $table->char('id', 13)->index();
            $table->char('district_id', 8);
            $table->string('name', 50);
            $table->foreign('district_id')
                ->references('id')
                ->on('MDistricts')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MVillages');
    }
};
