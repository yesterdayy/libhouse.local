<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MenuList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_menu_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item');
            $table->string('icon')->nullable();
            $table->string('class')->nullable();
            $table->integer('menu_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_menu_list');
    }
}
