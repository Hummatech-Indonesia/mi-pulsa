<?php

namespace App\Rules;

use App\Enums\WithdrawalEnum;
use Illuminate\Contracts\Validation\Rule;

class ViaRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array($value, [WithdrawalEnum::BLUEBCA->value, WithdrawalEnum::DANA->value, WithdrawalEnum::GOPAY->value, WithdrawalEnum::OVO->value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Metode pembayaran yang anda pilih tidak tersedia';
    }
}
