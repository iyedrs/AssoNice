<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('DISCIPLINE', function (Blueprint $table) {
            $table->id('DIS_ID');
            $table->string('DIS_NOM', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('DISCIPLINE');
    }
};
