<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private CustomerInterface $customer;
    public function __construct(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(Request $request):View
    {
        $customers = $this->customer->search($request);
        return view('dashboard.pages.customers.index', compact('customers'));
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
}
