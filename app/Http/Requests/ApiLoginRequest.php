<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends ApiRequest
{

    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'fcm_token' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus valid',
            'password.required' => 'Password tidak boleh kosong',
        ];
    }
}
