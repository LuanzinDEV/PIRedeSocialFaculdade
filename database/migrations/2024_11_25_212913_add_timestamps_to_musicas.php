<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToMusicas extends Migration
{
    /**
     * Adicione os campos `created_at` e `updated_at` à tabela `musicas`.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('musicas', function (Blueprint $table) {
            $table->timestamps(); // Adiciona `created_at` e `updated_at`
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('musicas', function (Blueprint $table) {
            $table->dropTimestamps(); // Remove as colunas `created_at` e `updated_at`
        });
    }
}
