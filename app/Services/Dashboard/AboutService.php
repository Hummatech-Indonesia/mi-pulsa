<?php

namespace App\Services\Dashboard;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\Dashboard\AboutInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\About;
use App\Models\Product;
use App\Models\Slider;
use App\Traits\UploadTrait;

class AboutService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private AboutInterface $about;

    public function __construct(AboutInterface $about)
    {
        $this->about = $about;
    }
    public function store(AboutRequest $request): array|bool
    {
        $data = $request->validated();

        $image = $this->uploadSlug(UploadDiskEnum::ABOUT->value, $request->file('image'), "about-mipulsa-" . now());

        return [
            'title' => $data['title'],
            'description' => $data['description'],
            'phone_number' => $data['phone_number'],
            'image' => $image,
        ];
    }

    /**
     * Method update
     *
     * @param Product $about [explicite description]
     * @param ProductRequest $request [explicite description]
     *
     * @return array
     */
    public function update(About $about, AboutRequest $request): array|bool
    {
        $data = $request->validated();

        $old_photo = $about->image;

        // Handle file upload
        if ($request->hasFile('image')) {
            if ($old_photo) {
                $this->remove($old_photo);
            }
            $old_photo = $this->uploadSlug(UploadDiskEnum::ABOUT->value, $request->file('image'), "product-mipulsa-" . now());
        }

        return [
            'title' => $data['title'],
            'phone_number' => $data['phone_number'],
            'description' => $data['description'],
            'image' => $old_photo,
        ];
    }
}
