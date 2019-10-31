<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormTempaltes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id');
            $table->string('email_from')->nullable();
            $table->string('email_reply_to')->nullable();
            $table->string('email_template')->nullable();
            $table->string('modal_title');
            $table->text('modal_body')->nullable();
            $table->text('modal_buttons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_templates');
    }
}
