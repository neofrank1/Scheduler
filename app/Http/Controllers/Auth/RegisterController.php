<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        $data['email'] = $data['reg_email'];
        $data['password'] = $data['reg_password'];
        return Validator::make($data, [
            'employee_id' => ['required', 'integer'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'integer'],
            'college_id' => ['nullable', 'integer'],
            'course_id' => ['nullable', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $data['email'] = $data['reg_email'];
        $data['password'] = $data['reg_password'];
        $data['status'] = ($data['user_type'] == 1) ? 1 : 0;
        return User::create([
            'employee_id' => $data['employee_id'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'user_type' => $data['user_type'],
            'college_id' => !empty($data['college_id']) ? $data['college_id'] :null,
            'course_id' => !empty($data['course_id']) ? $data['course_id'] : null,
            'email' => $data['email'],
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
