<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'phone_number' => 'required'
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
            'title.required' => 'Kolom judul wajib diisi',
            'description.required' => 'Kolom deskripsi wajib diisi',
            'phone_number.required' => 'Kolom nomor telepon wajib diisi',
        ];
    }
}
