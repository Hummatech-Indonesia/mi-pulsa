<?php

namespace App\Http\Requests;

use App\Rules\AdminRoleRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $request = [
            'name' => 'required',
            'email'=>'required|unique:users,email,except,id',
            'phone_number' => 'required',
            'password' => 'nullable|min:8',
            'role' => ['required', new AdminRoleRule],
        ];
        if(request()->routeIs('users.update')){
            $request['email']=['required','email',Rule::unique('users')->ignore($this->user)];
        }
        return $request;
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama kosong',
            'email.required' => 'Kolom email kosong',
            'phone_number.required' => 'Kolom nomor kosong',
            'password.nullable' => 'Kolom password kosong',
            'password.min' => 'Kolom password minimal 8 karakter',
            'role.required'=>'Kolom role kosong',
        ];
    }
}
