<?php

namespace App\Rules;

use App\Enums\ArticleStatusEnum;
use Illuminate\Contracts\Validation\Rule;

class StatusRule implements Rule
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
        return in_array($value, [ArticleStatusEnum::DRAFT->value, ArticleStatusEnum::PUBLISHED->value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Status tidak valid';
    }
}
