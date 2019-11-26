<?php

namespace App\Providers;

use App\Components\Shortcodes;
use Illuminate\Support\ServiceProvider;

class ShortcodesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Shortcodes::addShortcode('login-form', ['User\User', 'login_form']);
        Shortcodes::addShortcode('register-form', ['User\User', 'register_form']);
        Shortcodes::addShortcode('reset-password-form', ['User\User', 'reset_password']);

        Shortcodes::addShortcode('realty-list', ['Realty\Realty', 'realty_list']);
        Shortcodes::addShortcode('realty-cats-list', ['Realty\Realty', 'realty_cats_list']);

        Shortcodes::addShortcode('user-comments-list', ['Comment\Comment', 'user_comments_list']);

        Shortcodes::addShortcode('form', ['Forms\Form', 'form']);

        Shortcodes::addShortcode('blog-content', ['Blog\Post', 'blog_content']);
        Shortcodes::addShortcode('post-list', ['Blog\Post', 'post_list']);
        Shortcodes::addShortcode('related-posts', ['Blog\Post', 'related_posts']);

        Shortcodes::addShortcode('comments', ['Comment\Comment', 'comments']);

        Shortcodes::addShortcode('cats-list', ['Blog\Cats', 'cats_list']);
    }
}
