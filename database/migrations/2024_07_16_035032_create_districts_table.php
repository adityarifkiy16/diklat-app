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
        Schema::create('MDistricts', function (Blueprint $table) {
            $table->char('id', 8)->index();
            $table->char('regency_id', 5);
            $table->string('name', 50);
            $table->foreign('regency_id')
                ->references('id')
                ->on('MRegencies')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MDistricts');
    }
};
