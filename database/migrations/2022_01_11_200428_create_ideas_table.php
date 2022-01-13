<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->integer('votes_first')->default(0);
            $table->integer('votes_second')->default(0);
            $table->integer('criteria1')->default(-1);
            $table->integer('criteria2')->default(-1);
            $table->timestamps();

            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('session_id')->constrained('sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}
