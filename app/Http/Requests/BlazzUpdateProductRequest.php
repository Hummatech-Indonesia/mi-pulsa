<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlazzUpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'checkedValues' => 'required|array'
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
            'checkedValues.required' => 'Pilih setidaknya 1 pengguna yang ingin anda lakukan top up'
        ];
    }
}
