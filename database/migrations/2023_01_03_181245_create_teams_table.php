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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId('owner_id');
            $table->timestamps();

            $table->foreign('owner_id')
            ->references('id')
            ->on('users');
        });

        Schema::create('team_has_members', function (Blueprint $table) {
            $table->foreignId('team_id');
            $table->foreignId('user_id');

            $table->foreign('team_id')
            ->references('id')
            ->on("teams");

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->primary(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
