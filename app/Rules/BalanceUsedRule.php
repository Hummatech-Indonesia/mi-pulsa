<?php

namespace App\Rules;

use App\Enums\BalanceUsedEnum;
use Illuminate\Contracts\Validation\Rule;

class BalanceUsedRule implements Rule
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
        return in_array($value, [BalanceUsedEnum::TRIPAY->value, BalanceUsedEnum::REKENING->value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Metode Pembayaran Tidak Sesuai';
    }
}
