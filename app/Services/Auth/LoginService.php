<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\FcmTokenInterface;
use App\Helpers\ResponseHelper;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class LoginService
{
    private FcmTokenInterface $fcmToken;
    public function __construct(FcmTokenInterface $fcmToken)
    {
        $this->fcmToken = $fcmToken;
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return void
     *
     * @throws ValidationException
     */

    public function handleLoginUser(LoginRequest $request): void
    {
        $request->validated();

        if (!auth()->attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * handleLogin
     *
     * @param  mixed $request
     * @return mixed
     */
    public function handleLogin(ApiLoginRequest $request): mixed
    {
        $fcmToken = $this->fcmToken->get();
        $fcmToken->update(['fcm_token' => $request->fcm_token]);
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $data['token'] =  auth()->user()->createToken('auth_token')->plainTextToken;
            $data['user'] = UserResource::make(auth()->user());

            $id = auth()->user()->id;
            User::query()->findOrFail($id)
                ->update([
                    'api_token' => $data['token']
                ]);
            return ResponseHelper::success($data, trans('Berhasil melakukan login'));
        }

        return ResponseHelper::error(null, trans('Email atau password tidak sesuai'), Response::HTTP_BAD_REQUEST);
    }
}
