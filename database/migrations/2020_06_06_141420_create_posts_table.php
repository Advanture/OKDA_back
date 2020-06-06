<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('poll_id');
            $table->foreign('poll_id')
                ->references('id')->on('polls')->onDelete('cascade');

            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')
                ->references('id')->on('positions')->onDelete('cascade');

            $table->integer('status');
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
        Schema::dropIfExists('posts');
    }
}
