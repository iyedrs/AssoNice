<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CLUB_DISCIPLINE', function (Blueprint $table) {
            $table->unsignedBigInteger('CLUB_ID');
            $table->unsignedBigInteger('DISCIPLINE_ID');
            $table->primary(['CLUB_ID', 'DISCIPLINE_ID']);
            $table->foreign('CLUB_ID')->references('CLU_ID')->on('CLUB');
            $table->foreign('DISCIPLINE_ID')->references('DIS_ID')->on('DISCIPLINE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CLUB_DISCIPLINE');
    }
};
