<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Interfaces\RegisterInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Auth\RegisterService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

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
    private RegisterInterface $register;
    private RegisterService $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RegisterInterface $register, RegisterService $service)
    {
        $this->middleware('guest');
        $this->register = $register;
        $this->service = $service;
    }


    /**
     * Method showRegistrationForm
     *
     * @return View
     */
    public function showRegistrationForm(): View
    {
        $title = trans('title.register');
        return view('auth.register', compact('title'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->service->handleRegistration($request, $this->register);
        return back()->with('success', 'Berhasil melakukan pendaftaran');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
