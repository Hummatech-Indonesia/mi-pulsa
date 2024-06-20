<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'product_id' => 'required|exists:products,id',
            'phone_number' => 'required',
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
            'name.required' => 'Kolom nama tidak boleh kosong',
            'product.required' => 'Kolom produk tidak boleh kosong',
            'product.exists' => 'Kolom produk yang anda pilih tidak valid',
            'phone_number'=>'Kolom nomor telepon tidak boleh kosong',
        ];
    }
}
