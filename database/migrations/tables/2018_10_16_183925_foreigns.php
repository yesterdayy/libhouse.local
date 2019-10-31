<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foreigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_reviews', function (Blueprint $table) {
            $table->foreign('customer_source_id')->references('id')->on('site_reviews_source')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('menu_list', function (Blueprint $table) {
            $table->foreign('menu_id')->references('id')->on('menu')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('user_groups', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('blog_comments', function (Blueprint $table) {
            $table->foreign('entry_id')->references('id')->on('blog_entry')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('blog_entry_tags', function (Blueprint $table) {
            $table->foreign('entry_id')->references('id')->on('blog_entry')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('blog_tags')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('blog_entry_cats', function (Blueprint $table) {
            $table->foreign('entry_id')->references('id')->on('blog_entry')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('blog_cats')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('blog_entry_attachments', function (Blueprint $table) {
            $table->foreign('entry_id')->references('id')->on('blog_entry')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('attachment_id')->references('id')->on('attachments')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('blog_entry_meta', function (Blueprint $table) {
            $table->foreign('entry_id')->references('id')->on('blog_entry')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('form_fields', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::table('form_clients', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
