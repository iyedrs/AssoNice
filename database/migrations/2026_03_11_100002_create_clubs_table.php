<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('CLUB', function (Blueprint $table) {
            $table->id('CLU_ID');
            $table->string('CLU_NOM', 50)->nullable();
            $table->string('CLU_ADRESSEVILLE', 50)->nullable();
            $table->string('CLU_ADRESSERUE', 25)->nullable();
            $table->string('CLU_ADRESSECP', 6)->nullable();
            $table->string('CLU_MAIL', 25)->nullable();
            $table->string('CLU_TELFIXE', 8)->nullable();
            $table->unsignedBigInteger('DIS_ID')->nullable();
            $table->foreign('DIS_ID')->references('DIS_ID')->on('DISCIPLINE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('CLUB');
    }
};
