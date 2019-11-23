<?php

namespace App\Http\Controllers\Auth;

use App\Models\User\User;
use App\Http\Controllers\Controller;
use App\Models\User\UserCompany;
use function foo\func;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'realty_type' => $data['realty_type']
        ]);

        if (isset($data['phone']) && !empty($data['phone'])) {
            $user->info()->create([
                'user_id' => $user->id,
                'field' => 'phone',
                'value' => $data['phone'],
                'realty_type' => $data['realty_type']
            ]);
        }

        $company_info = [];
        $company_id = UserCompany::max('id') + 1;

        if (isset($data['company_address'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'address',
                'value' => $data['company_address']
            ];
        }

        if (isset($data['company_name'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'company_name',
                'value' => $data['company_name']
            ];
        }

        if (isset($data['company_phone'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'phone',
                'value' => $data['company_phone']
            ];
        }

        if (isset($data['company_work_time'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'work_time',
                'value' => $data['company_work_time']
            ];
        }

        if (isset($data['company_email'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'email',
                'value' => $data['company_email']
            ];
        }

        if (isset($data['company_vk'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'vk',
                'value' => $data['company_vk']
            ];
        }

        if (isset($data['company_ok'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'ok',
                'value' => $data['company_ok']
            ];
        }

        if (isset($data['company_facebook'])) {
            $company_info[] = [
                'id' => $company_id,
                'field' => 'facebook',
                'value' => $data['company_facebook']
            ];
        }

        if (!empty($company_info)) {
            UserCompany::insert($company_info);
            $user->company()->attach($company_id);
        }

        $company_attachments = [];
        if (isset($data['photos'])) {
            $company_attachments = array_merge(
                $company_attachments
                , array_map(function($photo) {
                return [
                    'type' => 'photo',
                    'attachment_id' => $photo,
                    'is_moderated' => 1
                ];
            }, $data['photos']));
        }

        if (isset($data['documents'])) {
            $company_attachments = array_merge(
                $company_attachments
                , array_map(function($document) {
                return [
                    'type' => 'document',
                    'attachment_id' => $document,
                    'is_moderated' => 0
                ];
            }, $data['documents']));
        }

        if (!empty($company_attachments)) {
            $user->company[0]->attachments()->attach($company_attachments);
        }

        return $user;
    }
}
