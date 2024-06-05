<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasSubArticleCategories
{
    /**
     * One-to-Many relationship with Article Model
     *
     * @return HasMany
     */

    public function sub_article_categories(): HasMany;
}
