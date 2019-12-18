<?php

namespace App\Http\Controllers;

use App\Models\Realty\Realty;
use App\Models\Realty\RealtyFilter;
use App\Models\Comment\Comment;
use App\Models\User\User;
use App\Models\User\UserRealtyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Fields\Input;

class UserController extends Controller
{

    public function show($user_id) {
        $user = User::findOrFail($user_id);

        $return = [
            'user' => $user,
            'is_my_page' => intval(Auth::id() == $user->id),
            'light_header' => true,
        ];

        // Для кнопочных фильтров считаем кол-во объявлений по каждому фильтру
        $return['btn_filters_count'] = Realty::get_btn_filters_count($user_id);

        return view('user.cabinet', $return);
    }

    public function edit($user_id) {
        $user = User::with('company')->findOrFail($user_id);
        $this->authorize('edit', $user);
        $realty_types = UserRealtyType::all();

        $return = [
            'user' => $user,
            'is_my_page' => intval(Auth::id() == $user->id),
            'realty_types' => $realty_types,
        ];

        $user->company = $user->company->pluck('value', 'field');

        return view('user.edit', $return);
    }

    public function get_phone(Request $request) {
        $user_id = addslashes(strip_tags($request->get('id')));

        if (!empty($user_id)) {
            $user = User::findOrFail($user_id);
            return response()->json(['phone' => $user->phone]);
        } else {
            return response()->json([]);
        }
    }

    public function get_cabinet_tab($author_id,  $tab) {
        $data = [];
        $data['author_id'] = $author_id;

        $btn_filter = request()->get('btn-filter');
        $data['btn_filter'] = $btn_filter;

        return view('user.tabs.' . $tab, $data);
    }

}
