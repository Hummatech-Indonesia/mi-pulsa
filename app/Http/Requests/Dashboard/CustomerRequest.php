<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'name' => 'required',
            'phone_number' => 'required',
            'provider' => 'required',
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
            'phone_number' => 'Kolom nomor telepon tidak boleh kosong',
            'provider' => 'Kolom provider tidak boleh kosong',
        ];
    }
}
