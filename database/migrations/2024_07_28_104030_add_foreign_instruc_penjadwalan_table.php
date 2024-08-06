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
        Schema::table('TPenjadwalan', function (Blueprint $table) {
            $table->unsignedBigInteger('instruct_id');
            $table->foreign('instruct_id')->references('id')->on('MInstructor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('TPenjadwalan', function (Blueprint $table) {
            $table->dropColumn('instruct_id');
            $table->dropForeign('instruct_id');
        });
    }
};
