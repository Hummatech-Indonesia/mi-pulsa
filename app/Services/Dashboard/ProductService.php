<?php

namespace App\Services\Dashboard;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\UploadTrait;

class ProductService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private ProductInterface $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }
    public function store(ProductRequest $request): array|bool
    {
        $data = $request->validated();


        // Handle file upload

          $logo=  $this->uploadSlug(UploadDiskEnum::PRODUCTS->value, $request->file('logo'), "product-mipulsa-" . now());

        return [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'logo' => $logo,
        ];
    }

    /**
     * Method update
     *
     * @param Product $product [explicite description]
     * @param ProductRequest $request [explicite description]
     *
     * @return array
     */
    public function update(Product $product, ProductRequest $request): array|bool
    {
        $data = $request->validated();

        $old_photo = $product->logo;

        // Handle file upload
        if ($request->hasFile('logo')) {
            if ($old_photo) {
                $this->remove($old_photo);
            }
            $old_photo = $this->uploadSlug(UploadDiskEnum::PRODUCTS->value, $request->file('logo'), "product-mipulsa-" . now());
        }

        return [
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
            'logo' => $old_photo,
        ];
    }
}
