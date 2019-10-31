<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entry_id')->unsigned()->nullable();
            $table->string('message');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('root_parent_id')->nullable();
            $table->timestamps();
            $table->index(['entry_id', 'parent_id', 'root_parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
