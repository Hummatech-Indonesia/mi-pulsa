<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class CustomersImport implements ToCollection, WithHeadingRow, WithValidation
{

    public function collection(Collection $rows)
    {
        $firstRow = true;
        foreach ($rows as $row) {
            if ($firstRow) {
                $firstRow = false;
                continue;
            }
            try {
                $product = Product::where('product_name', $row['produk'])->firstOrFail();
                Customer::create([
                    'name' => $row['nama'],
                    'phone_number' => $row['nomor_telepon'],
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->id,
                ]);
            } catch (\Exception $e) {
                continue;
            }
        }
    }
    public function rules(): array
    {
        return [
            'nama' => 'required',
            'produk' => 'required|exists:products,product_name',
            'nomor_telepon' => 'required'
        ];
    }
    public function customValidationMessages(): array
    {
        return [
            'nama.required' => 'Nama kosong',
            'produk.required' => 'Produk kosong',
            'produk.exists' => 'Produk yang diberikan tidak valid',
            'nomor_telepon.required' => 'Nomor telepon kosong',
        ];
    }
}
