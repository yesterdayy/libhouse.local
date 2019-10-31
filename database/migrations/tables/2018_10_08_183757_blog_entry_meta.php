<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogEntryMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entry_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entry_id')->unsigned()->nullable();
            $table->string('field');
            $table->string('value', 500);
            $table->index(['field']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_entry_meta');
    }
}
