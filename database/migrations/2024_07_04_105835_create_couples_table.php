<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouplesTable extends Migration
{
    public function up()
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // Vérifiez si la colonne 'couple_id' n'existe pas déjà avant de l'ajouter
        if (!Schema::hasColumn('users', 'couple_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('couple_id')->nullable()->constrained('couples')->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['couple_id']);
            $table->dropColumn('couple_id');
        });

        Schema::dropIfExists('couples');
    }
}
