<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Enums\RoleEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Auth\LoginService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private LoginService $loginService;
    private FcmTokenInterface $fcmToken;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService, FcmTokenInterface $fcmToken)
    {
        $this->middleware('guest')->except('logout');
        $this->fcmToken = $fcmToken;
        $this->loginService = $loginService;
    }

    /**
     * Show the application's login form.
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        $title = trans('title.login');
        return view('auth.login', compact('title'));
    }


    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */

    public function login(LoginRequest $request): RedirectResponse
    {
        $this->loginService->handleLoginUser($request);
        return to_route('dashboard.index')->with('success','Berhasil login');
    }

    /**
     * apiLogin
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function apiLogin(ApiLoginRequest $request): JsonResponse
    {
        return $this->loginService->handleLogin($request);
    }
}
