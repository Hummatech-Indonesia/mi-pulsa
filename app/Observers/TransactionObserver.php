<?php

namespace App\Observers;

use App\Models\Transaction;
use Faker\Provider\Uuid;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function creating(Transaction $transaction): void
    {
        $transaction->id = Uuid::uuid();
    }
}
