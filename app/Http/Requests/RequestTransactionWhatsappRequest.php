<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestTransactionWhatsappRequest extends FormRequest
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
            'user_id' => 'required',
            'balance' => 'required',
            'method' => 'required',
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
            'user_id.required' => 'Kolom pengguna wajib diisi',
            'balance.required' => 'Kolom nominal wajib diisi',
            'method.required' => 'Kolom metode pembayaran wajib diisi',
        ];
    }
}
