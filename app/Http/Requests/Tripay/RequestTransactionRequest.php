<?php

namespace App\Http\Requests\Tripay;

use Illuminate\Foundation\Http\FormRequest;

class RequestTransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
            'balance.required' => 'Saldo wajib diisi',
            'method.required' => 'Metode pembayaran wajib diisi'
        ];
    }
}
