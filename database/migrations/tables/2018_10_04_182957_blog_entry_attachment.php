<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BlogEntryAttachment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entry_attachments', function (Blueprint $table) {
            $table->integer('entry_id')->unsigned()->nullable();
            $table->string('type');
            $table->integer('attachment_id')->unsigned()->nullable();
            $table->timestamps();
            $table->index(['type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_entry_attachments');
    }
}
