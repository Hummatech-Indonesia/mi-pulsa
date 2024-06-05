<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Models\Product;
use App\Services\Dashboard\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductInterface $product;
    private ProductService $service;
    public function __construct(ProductInterface $product,ProductService $service)
    {
        $this->product = $product;
        $this->service = $service;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $products = $this->product->get();
        return view('dashboard.pages.products.index', compact('products'));
    }
    /**
     * Method store
     *
     * @param ProductRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $this->product->store($this->service->store($request));
        return back()->with('success', 'Berhasil menambah data');
    }
    /**
     * Method update
     *
     * @param ProductRequest $request [explicite description]
     * @param Product $product [explicite description]
     *
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $this->product->update($product->id, $this->service->update($product,$request));
        return back()->with('success', 'Berhasil mengubah data');
    }
    /**
     * Method destroy
     *
     * @param Product $product [explicite description]
     *
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->product->delete($product->id);
        return back()->with('success', 'Berhasil menghapus data');
    }
}
