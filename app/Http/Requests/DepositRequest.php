<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bank' => 'required',
            'amount' => 'required'
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages(): array
    {
        return [
            'bank.required' => 'Bank Tujuan wajib diisi',
            'amount.required' => 'Nominal wajib diisi'
        ];
    }
}
