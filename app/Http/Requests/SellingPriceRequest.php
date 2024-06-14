<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellingPriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'selling_price' => 'required|integer',
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'selling_price.required' => 'Harga Jual Wajib diisi'
        ];
    }
}
