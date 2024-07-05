<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildPresencesTable extends Migration
{
    public function up()
    {
        Schema::create('child_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->boolean('morning')->default(false);
            $table->boolean('noon')->default(false);
            $table->boolean('evening')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_presences');
    }
}
