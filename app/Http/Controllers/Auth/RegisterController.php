<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = RouteServiceProvider::HOME;


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
        return Validator::make(
            $data,
            [
                'name' => ['required', 'regex:/^[\pL\s\-]+$/', 'string', 'min:5', 'max:255', 'unique:users,name'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:5', 'confirmed'],
                'mobile' => ['required', 'numeric', 'digits:10', 'regex:/^(09|03|07)\d{8}$/'],
            ]
        );
    }
    // Password: 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-z\d@$!%*#?&]{8,}$/'
    // Name: regex:/^[A-Za-z]+((\s)?([A-Za-z])+)*$/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $rand_id = rand(1111111111, 999999999);
        $query = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'city' => '',
            'state' => '',
            'country' => '',
            'gender' => '',
            'birthdate' => '',
            'address' => '',
            'status' => '1',
            'role_as' => '0',
            'is_verify' => '0',
            'rand_id' => $rand_id
        ]);
        if ($query) {
            $dataa = ['name' => $data['name'], 'rand_id' => $rand_id];
            $user['to'] = $data['email'];
            Mail::send(
                'email/email_verification',
                $dataa,
                function ($messages) use ($user) {
                    $messages->to($user['to']);
                    $messages->subject('HPhone Website [Account Verification]');
                }
            );
            return redirect('/home')->with('status', 'Registration succesfully! Please check your email for verification!');
        }
    }
}
