<?php

namespace App\Base\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasSubArticleCategory
{

    /**
     * One-to-Many relationship with User Model
     *
     * @return BelongsTo
     */

    public function sub_article_category(): BelongsTo;
}
