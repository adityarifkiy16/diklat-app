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
            $table->foreign('tempat_lahir')
                ->references('id')
                ->on('MRegencies')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('MPeserta', function (Blueprint $table) {
            $table->dropForeign('MPeserta_tempat_lahir_foreign');
        });
    }
};
