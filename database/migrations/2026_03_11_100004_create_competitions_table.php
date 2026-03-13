<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('COMPETITION', function (Blueprint $table) {
            $table->id('COM_ID');
            $table->unsignedBigInteger('CLU_ID');
            $table->unsignedBigInteger('DIS_ID');
            $table->unsignedBigInteger('CLU_ID_LOCAL');
            $table->string('COM_NOM', 50)->nullable();
            $table->date('COM_DATE')->nullable();
            $table->foreign('CLU_ID')->references('CLU_ID')->on('CLUB');
            $table->foreign('DIS_ID')->references('DIS_ID')->on('DISCIPLINE');
            $table->foreign('CLU_ID_LOCAL')->references('CLU_ID')->on('CLUB');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('COMPETITION');
    }
};
