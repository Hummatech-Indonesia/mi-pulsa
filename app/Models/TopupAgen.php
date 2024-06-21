<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopupAgen extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'char';
    protected $primaryKey = 'id';
    protected $table = 'topup_agens';
    protected $fillable = ['user_id', 'invoice_id', 'fee_amount', 'invoice_url', 'expiry_date', 'paid_amount', 'amount', 'paid_at', 'payment_channel', 'payment_method', 'status', 'transaction_via', 'pay_code'];


    /**
     * Get the user that owns the TopupAgen
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
