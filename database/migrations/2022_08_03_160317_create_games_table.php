<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home')->references('id')->on('teams');
            $table->foreignId('away')->references('id')->on('teams');
            $table->date('date');
            $table->time('time');
            $table->enum('status', [
                'FINISHED', 'SCHEDULED', 'PENDING', 'CANCELLED'
            ])->default('SCHEDULED');
            $table->integer('home_score')->default(0);
            $table->integer('away_score')->default(0);
            $table->enum('winner', ['HOME', 'AWAY', 'DRAW'])->default('DRAW');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
