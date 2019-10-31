<?php

namespace App\Http\Controllers;

use App\Models\Realty\RealtyFilter;
use App\Models\Comment\Comment;
use App\Models\User\User;
use App\Models\User\UserRealtyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show($user_id) {
        $user = User::findOrFail($user_id);

        $return = [
            'user' => $user,
            'is_my_page' => intval(Auth::id() == $user->id)
        ];

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

}
