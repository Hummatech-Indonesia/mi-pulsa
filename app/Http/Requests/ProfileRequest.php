<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required',
            'password'=>'nullable|min:8',
            'phone_number'=>'nullable',
            'photo'=>'nullable|image|mimes:png,jpg',
            'address'=>"nullable",
        ];
    }
    public function messages():array
    {
        return [
            'photo.mimes'=>'Hanya ekstensi png dan jpg yang diperbolehkan',
            'name.required'=>"Kolom nama tidak boleh kosong",
            'email.required'=>"Kolom email tidak boleh kosong",
            'phone_number.required'=>"Kolom nomor telepon tidak boleh kosong",
            'password'=>"Kolom password minimal 8 karakter",
        ];
    }
}
