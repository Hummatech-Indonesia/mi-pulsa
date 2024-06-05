<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Slider;
use App\Traits\UploadTrait;

class ProfileService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private ProfileInterface $profile;

    public function __construct(ProfileInterface $profile)
    {
        $this->profile = $profile;
    }


    public function update(ProfileRequest $request): array|bool
    {
        $data = $request->validated();

        $old_photo = auth()->user()->photo;

        // Handle file upload
        if ($request->hasFile('photo')) {
            if ($old_photo) {
                $this->remove($old_photo);
            }
            $old_photo = $this->uploadSlug(UploadDiskEnum::USERS->value, $request->file('photo'), "user-mipulsa-" . now());
        }

        return [
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'address' => $data['address'],
            'photo' => $old_photo,
        ];
    }
}
