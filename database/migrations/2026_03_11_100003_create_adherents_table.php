<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ADHERENT', function (Blueprint $table) {
            $table->id('ADH_ID');
            $table->unsignedBigInteger('CLU_ID');
            $table->unsignedBigInteger('DIS_ID');
            $table->string('ADH_NOM', 50)->nullable();
            $table->string('ADH_PRENOM', 25)->nullable();
            $table->date('ADH_DDN')->nullable();
            $table->string('ADH_ADRESSE', 50)->nullable();
            $table->string('ADH_HASH_PWD', 256)->nullable();
            $table->string('ADH_EMAIL', 100)->nullable();
            $table->integer('ADH_ROLE')->default(0);
            $table->foreign('CLU_ID')->references('CLU_ID')->on('CLUB');
            $table->foreign('DIS_ID')->references('DIS_ID')->on('DISCIPLINE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ADHERENT');
    }
};
