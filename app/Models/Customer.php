<?php

namespace App\Models;

use App\Base\Interfaces\HasProduct;
use App\Base\Interfaces\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model implements HasUser, HasProduct
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'user_id', 'product_id'];

    public $incrementing = false;
    public $keyType = 'char';
    protected $primaryKey = 'id';
    /**
     * Get the user that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * product
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
