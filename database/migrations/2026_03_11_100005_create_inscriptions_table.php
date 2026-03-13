<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('INSCRIPTION', function (Blueprint $table) {
            $table->id('INS_NUM');
            $table->unsignedBigInteger('ADH_ID');
            $table->unsignedBigInteger('COM_ID');
            $table->date('INS_DATE')->nullable();
            $table->tinyInteger('INS_ETAT')->nullable();
            $table->foreign('ADH_ID')->references('ADH_ID')->on('ADHERENT');
            $table->foreign('COM_ID')->references('COM_ID')->on('COMPETITION');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('INSCRIPTION');
    }
};
