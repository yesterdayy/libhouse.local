<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('placeholder')->nullable();
            $table->string('value')->nullable();
            $table->string('label', 500)->nullable();
            $table->tinyInteger('is_required');
            $table->string('div_id')->nullable();
            $table->string('div_class')->nullable();
            $table->integer('order')->nullable();
            $table->integer('form_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_fields');
    }
}
