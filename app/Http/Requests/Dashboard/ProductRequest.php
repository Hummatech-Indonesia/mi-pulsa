<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required|unique:products,name',
            'logo'=>'nullable',
            'description'=>'required',
            'price'=>'required',
        ];
    }
    /**
     * Method messages
     *
     * @return array
     */
    public function messages():array
    {
        return [
            'name.required'=>'Kolom nama tidak boleh kosong',
            'name.unique'=>'Nama tidak tersedia',
            'description.required'=>'Kolom deskripsi tidak boleh kosong',
            'price.required'=>'Kolom harga tidak boleh kosong',
        ];
    }
}
