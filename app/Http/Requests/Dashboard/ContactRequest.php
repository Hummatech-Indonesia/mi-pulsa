<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'phone_number' => 'required',
            'email' => "required",
            'address' => "required",
        ];
    }
    /**
     * Method messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'phone_number.required' => 'Kolom nomor telepon wajib diisi',
            'email.required' => 'Kolom email wajib diisi',
            'address.required' => 'Kolom alamat wajib diisi',
        ];
    }
}
