<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog\Post;
use App\Models\Blog\Tags;
use App\Models\Menu\MenuList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelperAdminController extends Controller
{

    /*
     * ТЕГИ
     */
    public function search(string $tag = null) {
        if ($tag && $tag != 'undefined') {
            return response()->json(Tags::where('name', 'like', $tag . '%')->take(10)->get()->toArray());
        } else {
            return response()->json([]);
        }
    }

    /*
     * МЕНЮ
     */
//    public function menu_order(Request $request) {
//        $form_id = $request->get('form_id');
//        $orders = $request->get('order');
//
//        if ($form_id) {
//            foreach ($orders as $id => $order) {
//                if (is_numeric($id)) {
//                    MenuList::where('id', $id)->update(['order' => $order]);
//                }
//            }
//        }
//    }

    public function search_entry(Request $request) {
        $term = $request->input('term');
        return response()->json([
            [
                'text' => 'Страницы',
                'children' => Post::where('title', 'like', $term . '%')->where('type', 'page')->where('status', 'published')->take(10)->get()
            ],
            [
                'text' => 'Записи',
                'children' => Post::where('title', 'like', $term . '%')->where('type', 'post')->where('status', 'published')->take(10)->get()
            ],
        ]);
    }

}
