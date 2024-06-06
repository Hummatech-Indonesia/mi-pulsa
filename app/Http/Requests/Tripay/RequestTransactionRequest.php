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
            'saldo' => 'required',
            'method' => 'required',
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'saldo.required' => 'Saldo wajib diisi',
            'method.required' => 'Metode pembayaran wajib diisi'
        ];
    }
}
