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
        Schema::table('MPeserta', function (Blueprint $table) {
            $table->char('tempat_lahir', 5)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('MPeserta', function (Blueprint $table) {
            $table->string('tempat_lahir')->change();
        });
    }
};
