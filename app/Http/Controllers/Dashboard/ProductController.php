<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\Requests\SellingPriceRequest;
use App\Models\Product;
use App\Services\Dashboard\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductInterface $product;
    private ProductService $service;
    public function __construct(ProductInterface $product, ProductService $service)
    {
        $this->product = $product;
        $this->service = $service;
    }
    /**
     * Method index
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $products = $this->product->search($request);
        return view('dashboard.pages.products.index', compact('products'));
    }

    /**
     * jsonCategory
     *
     * @return JsonResponse
     */
    public function jsonProduct(): JsonResponse
    {
        $products = $this->product->get();
        return ResponseHelper::success($products);
    }

    /**
     * sellingPrice
     *
     * @return RedirectResponse
     */
    public function sellingPrice(Product $product, SellingPriceRequest $request): RedirectResponse
    {
        $this->product->update($product->id, $request->validated());
        return redirect()->back()->with('success', 'Sukses memperbarui harga jual');
    }
}
