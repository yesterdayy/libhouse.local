<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEmailChangeRequest;
use App\Http\Requests\UserPhoneChangeRequest;
use App\Models\Email\EmailQueue;
use App\Models\EmailHelpers\User\EmailUserEmailChange;
use App\Models\Realty\Realty;
use App\Models\Realty\RealtyFilter;
use App\Models\Comment\Comment;
use App\Models\User\User;
use App\Models\User\UserRealtyType;
use Carbon\Carbon;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Fields\Input;
use function Sodium\add;

class UserController extends Controller
{

    public function show($user_id) {
        $user = User::with('realty_type')->findOrFail($user_id);

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
            $user = User::select('phone')->findOrFail($user_id);
            return response()->json(['phone' => $user->phone]);
        } else {
            return response()->json([]);
        }
    }

    public function set_phone(UserPhoneChangeRequest $request) {
         try {
            $this->authorize('auth', Auth::user());

            $user = Auth::user();

             if ($request->get('phone') == $user->phone) {
                 return toast_response('success', 'Ничего не изменено');
             }

            $user->phone = clear_string($request->get('phone'));
            $user->save();

            return toast_response('success', 'Номер телефона изменен');
        } catch (\Exception $exception) {
            return toast_response('error', 'Произошла ошибка. Повторите позже');
        }
    }

    public function change_email(UserEmailChangeRequest $request) {
        try {
            $new_email = clear_string($request->get('new_email'));

            if ($request->get('new_email') == Auth::user()->email) {
                return toast_response('success', 'Ничего не изменено');
            }

            if (!empty($new_email)) {
                EmailUserEmailChange::add_to_queue($new_email);
                return toast_response('success', 'Заявка на смену почты отправлена на старый email');
            }
        } catch (\Exception $exception) {
            return toast_response('error', 'Произошла ошибка. Повторите позже');
        }
    }

    public function set_email(Request $request) {
        $token = $request->get('token');

        $message = '';
        if (Auth::check()) {
            $is_valid = EmailUserEmailChange::isValidToken(Auth::id(), $token);

            if ($is_valid) {
                EmailUserEmailChange::useLastValidToken(Auth::user());
                EmailUserEmailChange::unActiveOtherUserTokens(Auth::id());
                $message = 'Ваш email изменен.';
            } else {
                $message = 'Данная заявка устарела или не существует.';
            }
        } else {
            $message = 'Авторизуйтесь под своим аккаунтом для дальнейших действий.';
        }

        return view('user.email_change', compact('message'));
    }

    public function set_fib(Request $request) {
        try {
            $this->authorize('auth', Auth::user());

            $user = Auth::user();

//            if ($request->get('phone') == $user->phone) {
//                return toast_response('success', 'Ничего не изменено');
//            }

            $user->last_name = clear_string($request->get('last_name'));
            $user->first_name = clear_string($request->get('first_name'));
            $birthdate = clear_string($request->get('birthdate'));
            $user->birthdate = $birthdate && strtotime($birthdate) ? date('Y-m-d', strtotime($birthdate)) : null;
            $user->save();

            return toast_response('success', 'Информация обновлена');
        } catch (\Exception $exception) {
            return toast_response('error', 'Произошла ошибка. Повторите позже');
        }
    }

    public function set_password(Request $request) {
        try {
            $this->authorize('auth', Auth::user());

            $user = Auth::user();

            if ($request->get('old_password') == $request->get('new_password')) {
                return toast_response('success', 'Ничего не изменено');
            }

            if (!Hash::check($request->get('old_password'), $user->password)) {
                return toast_response('error', 'Старый пароль некорректный.');
            }

            $user->password = Hash::make($request->get('new_password'));
            $user->save();

            return toast_response('success', 'Пароль сохранен');
        } catch (\Exception $exception) {
            return toast_response('error', 'Произошла ошибка. Повторите позже');
        }
    }

    public function get_cabinet_tab($author_id,  $tab) {
        $data = [];
        $data['user'] = Auth::user();
        $data['author_id'] = $author_id;

        $btn_filter = request()->get('btn-filter');
        $data['btn_filter'] = $btn_filter;

        return view('user.tabs.' . $tab, $data);
    }

}
