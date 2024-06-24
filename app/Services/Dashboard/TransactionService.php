<?php

namespace App\Services\Dashboard;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\StatusTransactionEnum;
use App\Enums\TopupViaEnum;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\ProductRequest;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RequestTransactionWhatsappRequest;
use App\Models\Product;
use App\Models\Slider;
use App\Models\TopupAgen;
use App\Traits\UploadTrait;

class TransactionService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private TopupAgenInterface $topup;
    private UserInterface $user;

    public function __construct(TopupAgenInterface $topup, UserInterface $user)
    {
        $this->topup = $topup;
        $this->user = $user;
    }
    public function store(RequestTransactionWhatsappRequest $request): array|bool
    {
        $data = $request->validated();
        $getYear = substr(now()->format('Y'), -2);
        $count = TopupAgen::count() + 1;
        $external_id = "MPLS" . $getYear . str_pad($count, 4, '0', STR_PAD_LEFT);
        $user = $this->user->show($data['user_id']);
        $user->update(['saldo' => $user->saldo + $data['balance']]);
        return [
            'amount' => $data['balance'],
            'user_id' => $data['user_id'],
            'payment_method' => $data['method'],
            'invoice_id' => $external_id,
            'status' => StatusTransactionEnum::UNPAID->value,
            'transaction_via' => TopupViaEnum::WHATSAPP->value,
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
