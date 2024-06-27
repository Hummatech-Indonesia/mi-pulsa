<?php

namespace App\Jobs;

use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Models\Customer;
use App\Services\Dashboard\DigiFlazzService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BlazzTopUpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customer;
    protected $blazz_id;
    private ProductInterface $product;
    private TransactionInterface $transaction;
    /**
     * Create a new job instance.
     */
    public function __construct(Customer $customer, $blazz_id, ProductInterface $product, TransactionInterface $transaction)
    {
        $this->customer = $customer;
        $this->blazz_id = $blazz_id;
        $this->product = $product;
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $service = new DigiFlazzService();
        $service->topUp($this->customer, $this->blazz_id, $this->product, $this->transaction);
    }
}
