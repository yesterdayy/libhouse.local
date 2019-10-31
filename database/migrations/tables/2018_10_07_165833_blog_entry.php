<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entry', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 500);
            $table->longText('content');
            $table->string('type');
            $table->enum('status', ['published','draft','protected','trash']);
            $table->string('slug')->nullable();
            $table->integer('author_id');
            $table->dateTime('publicated_at');
            $table->dateTime('expired_at');
            $table->timestamps();
            $table->index(['title', 'type', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_entry');
    }
}
