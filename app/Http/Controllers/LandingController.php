<?php

namespace App\Http\Controllers;

use App\Models\Blog\Page;
use App\Models\Blog\Post;
use App\Models\Cards\Card;
use App\Components\Shortcodes;
use App\Models\Forms\Form;
use App\Models\Menu\Menu;
use App\Providers\ShortcodeServiceProvider;
use App\Models\SiteReview\SiteReview;
use App\Models\Common\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LandingController extends Controller
{
    public function index() {
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
            $query->where('field', 'main_page');
        })->first();
        $page->meta_data = $page->meta->keyBy('field');
        $GLOBALS['page'] = $page;

        return view('index', compact(
            'cards',
            'reviews'
        ));
    }
}
