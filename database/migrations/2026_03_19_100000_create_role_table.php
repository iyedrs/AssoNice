<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ROLE')) {
            Schema::create('ROLE', function (Blueprint $table) {
                $table->integer('ROL_ID')->primary();
                $table->string('ROL_LIBELLE', 50);
            });

            DB::table('ROLE')->insert([
                ['ROL_ID' => 0, 'ROL_LIBELLE' => 'Adhérent'],
                ['ROL_ID' => 1, 'ROL_LIBELLE' => 'Entraîneur'],
                ['ROL_ID' => 2, 'ROL_LIBELLE' => 'Administrateur plateforme'],
            ]);
        }

        // Mettre à 0 les NULL existants
        DB::statement("UPDATE `ADHERENT` SET `ADH_ROLE` = 0 WHERE `ADH_ROLE` IS NULL");

        // Ajouter la FK seulement si elle n'existe pas
        $fkExists = DB::select("
            SELECT COUNT(*) as cnt FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_NAME = 'ADHERENT_ibfk_3' AND TABLE_NAME = 'ADHERENT'
        ");
        if ($fkExists[0]->cnt == 0) {
            Schema::table('ADHERENT', function (Blueprint $table) {
                $table->integer('ADH_ROLE')->nullable(false)->default(0)->change();
                $table->foreign('ADH_ROLE', 'ADHERENT_ibfk_3')->references('ROL_ID')->on('ROLE');
            });
        }
    }

    public function down(): void
    {
        Schema::table('ADHERENT', function (Blueprint $table) {
            $table->dropForeign('ADHERENT_ibfk_3');
        });

        Schema::dropIfExists('ROLE');
    }
};
