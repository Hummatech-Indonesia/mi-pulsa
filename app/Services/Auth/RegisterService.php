<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\RegisterInterface;
use App\Enums\RoleEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class RegisterService
{

    /**
     * Handle school registration form
     *
     * @param RegisterRequest $request
     * @param RegisterInterface $register
     * @return void
     */

    public function handleRegistration(RegisterRequest $request, RegisterInterface $register): void
    {
        $data = $request->validated();
        $password = bcrypt($data['password']);

        $user = $register->store([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password,
            'role' => RoleEnum::AGENT->value
        ]);

        $user->assignRole(RoleEnum::AGENT->value);

        event(new Registered($user));
    }
}
