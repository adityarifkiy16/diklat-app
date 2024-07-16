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
        Schema::create('MRegencies', function (Blueprint $table) {
            $table->char('id', 5)->index();
            $table->char('province_id', 2);
            $table->string('name', 50);
            $table->foreign('province_id')
                ->references('id')
                ->on('MProvinces')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MRegencies');
    }
};
