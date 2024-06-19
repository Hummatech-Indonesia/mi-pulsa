<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {


        foreach ($rows as $row) {
            $product = Product::where('product_name', $row['product'])->first();
            if ($product != null) {
                Customer::create([
                    'name' => $row['name'],
                    'phone_number' => $row['phone_number'],
                    'product_id' => $product['id'],
                    'user_id' => auth()->user()->id,
                ]);
            }
        }
    }
    public function rules(): array
    {
        return [
            'product_id' => Rule::exists('products', 'id') 
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.exists' => 'ID produk yang diberikan tidak valid.'
        ];
    }
}
