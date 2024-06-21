<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
}
