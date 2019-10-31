<?php

namespace App\Http\Controllers;

use App\Models\Realty\Realty;
use App\Models\Blog\Cats;
use App\Models\Blog\Meta;
use App\Models\Blog\Page;
use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use App\Models\Common\Settings;
use App\Models\User\User;
use App\Models\User\UserCompany;
use DebugBar\DataCollector\MessagesCollector;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function filter_posts(Request $request) {
        if ($request->ajax()) {
            echo Post::getPosts($request->all());
            exit;
        }
    }

    public function landing_page() {

        $cards = Post::where('type', 'business_card')
            ->where('status', 'published')
            ->whereHas('meta', function ($query) {
                $query->where('field', 'card_position')->where('value', 'left');
            })
            ->orderBy('id', 'desc')
            ->take(1)->get();
        $cards = $cards->merge(
            Post::where('type', 'business_card')
                ->where('status', 'published')
                ->whereHas('meta', function ($query) {
                    $query->where('field', 'card_position')->where('value', 'right');
                })
                ->orderBy('id', 'desc')
                ->take(1)->get());

        $reviews = Post::where('type', 'site_review')->where('status', 'published')->orderBy('id', 'desc')->take(6)->get();

        $page = Page::with('meta')->where('status', 'published')->whereHas('meta', function ($query) {
            $query->where('field', 'page_type')->where('value', 'main_page');
        })->first();
        $page->meta_data = $page->meta->keyBy('field');
        $GLOBALS['page'] = $page;

        return view('index', compact(
            'cards',
            'reviews'
        ));
    }

    public function single_page($slug_1, $slug_2 = null) {
        if ($slug_1 && isset($slug_2) && $slug_2) {
            $slug = $slug_1 . '/' . $slug_2;
        } else {
            $slug = $slug_1;
        }

        if (!$slug) {
            return $this->landing_page();
        }

        $post = Post::getSingle($slug);
        if ($post) {
            return $post;
        }
    }

    public function cat($id) {
        if ($id) {
            return Cats::getCatPage($id);
        }
    }

    public function tag($id) {
        if ($id) {
            return Tags::getTagPage($id);
        }
    }

    public function share($post_id) {
        if (!empty($post_id)) {
            $likes = Meta::where('entry_id', $post_id)->where('field', 'likes')->first();

            if (!$likes) {
                $post = Post::find($post_id);
                $likes = new Meta(['field' => 'likes', 'value' => 1]);
                $post->meta()->save($likes);
            } else {
                $likes->increment('value');
                $likes->save();
            }
            return $likes->value;
        } else {
            return false;
        }
    }

    public function upload() {
        Post::upload('cover');
    }

}
