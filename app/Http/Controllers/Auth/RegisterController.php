<?php

namespace App\Http\Controllers\Auth;

use App\Models\EmailHelpers\User\EmailUserRegister;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Models\User\UserSubscribe;
use App\Rules\EmailRFC;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'unique:users', new EmailRFC],
            'password' => 'required|string|min:6',
            'phone' => 'required|phone:RU',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return App\Models\User\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => clear_string($data['email']),
            'password' => Hash::make(clear_string($data['password'])),
            'realty_type' => (isset($data['realtor']) ? '2' : '1'),
            'phone' => clear_numeric($data['phone']),
        ]);

        if (isset($data['subscribe']) && $user) {
            UserSubscribe::create(['user_id' => $user->id]);
        }

//        if (isset($data['phone']) && !empty($data['phone'])) {
//            $user->info()->create([
//                'user_id' => $user->id,
//                'field' => 'phone',
//                'value' => $data['phone'],
//                'realty_type' => $data['realty_type']
//            ]);
//        }
//
//        $company_info = [];
//        $company_id = UserCompany::max('id') + 1;
//
//        if (isset($data['company_address'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'address',
//                'value' => $data['company_address']
//            ];
//        }
//
//        if (isset($data['company_name'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'company_name',
//                'value' => $data['company_name']
//            ];
//        }
//
//        if (isset($data['company_phone'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'phone',
//                'value' => $data['company_phone']
//            ];
//        }
//
//        if (isset($data['company_work_time'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'work_time',
//                'value' => $data['company_work_time']
//            ];
//        }
//
//        if (isset($data['company_email'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'email',
//                'value' => $data['company_email']
//            ];
//        }
//
//        if (isset($data['company_vk'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'vk',
//                'value' => $data['company_vk']
//            ];
//        }
//
//        if (isset($data['company_ok'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'ok',
//                'value' => $data['company_ok']
//            ];
//        }
//
//        if (isset($data['company_facebook'])) {
//            $company_info[] = [
//                'id' => $company_id,
//                'field' => 'facebook',
//                'value' => $data['company_facebook']
//            ];
//        }
//
//        if (!empty($company_info)) {
//            UserCompany::insert($company_info);
//            $user->company()->attach($company_id);
//        }
//
//        $company_attachments = [];
//        if (isset($data['photos'])) {
//            $company_attachments = array_merge(
//                $company_attachments
//                , array_map(function($photo) {
//                return [
//                    'type' => 'photo',
//                    'attachment_id' => $photo,
//                    'is_moderated' => 1
//                ];
//            }, $data['photos']));
//        }
//
//        if (isset($data['documents'])) {
//            $company_attachments = array_merge(
//                $company_attachments
//                , array_map(function($document) {
//                return [
//                    'type'    => 'document',
//                    'attachment_id' => $document,
//                    'is_moderated' => 0
//                ];
//            }, $data['documents']));
//        }
//
//        if (!empty($company_attachments)) {
//            $user->company[0]->attachments()->attach($company_attachments);
//        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        $result = [];
        if ($this->registered($request, $user)) {
            $result = [
              'status' => 'error',
              'message' => 'Вы авторизованы',
            ];
        } else {
            EmailUserRegister::add_to_queue($user);

            $result = [
                'status' => 'success',
                'redirect' => self::redirectPath()
            ];
        }

        return response()->json($result);
    }
}
