<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerProductRequest;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Imports\CustomersImport;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    private CustomerInterface $customer;
    private ProductInterface $product;
    public function __construct(CustomerInterface $customer, ProductInterface $product)
    {
        $this->customer = $customer;
        $this->product = $product;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $customers = $this->customer->search($request);
        $products = $this->product->get();
        return view('dashboard.pages.customers.index', compact('customers', 'products'));
    }
    /**
     * Method store
     *
     * @param CustomerRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        $this->customer->store($request->validated());
        return back()->with('success', 'Berhasil menambah data');
    }
    /**
     * Method update
     *
     * @param CustomerRequest $request [explicite description]
     * @param Customer $customer [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $this->customer->update($customer->id, $request->validated());
        return back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Method destroy
     *
     * @param Customer $customer [explicite description]
     *
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $this->customer->delete($customer->id);
        return back()->with('success', 'Berhasil menghapus data');
    }

    /**
     * import
     *
     * @param  mixed $request
     * @return void
     */
    public function import(Request $request)
    {
        Excel::import(new CustomersImport, $request->file('file'));

        return back()->with('success', 'Berhasil melakukan import Pelanggan');
    }

    /**
     * customerProduct
     *
     * @return RedirectResponse
     */
    public function customerProduct(Customer $customer, CustomerProductRequest $request): RedirectResponse
    {
        $this->customer->update($customer->id, ['product_id' => $request->product_id]);
        return redirect()->back()->with('success', 'Berhasil memperbarui produk');
    }
}
