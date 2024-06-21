<?php

namespace App\Models;

use App\Base\Interfaces\HasCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model implements HasCustomer
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'char';
    protected $primaryKey = 'id';
    protected $table = 'transactions';

    protected $fillable = [
        'customer_id',
        'product_id',
        'ref_id',
        'customer_no',
        'buyer_last_saldo',
        'price',
        'tele',
        'wa',
        'message',
        'status',
        'blazz_id'
    ];

    /**
     * customer
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
