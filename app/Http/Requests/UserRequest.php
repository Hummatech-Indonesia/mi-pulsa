<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'nullable|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama kosong',
            'email.required' => 'Kolom email kosong',
            'phone_number.required' => 'Kolom nomor kosong',
            'password.nullable' => 'Kolom password kosong',
            'password.min' => 'Kolom password minimal 8 karakter',
        ];
    }
}
