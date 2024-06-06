<?php

use App\Enums\StatusTransactionEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topup_agens', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->char('invoice_id', 50)->unique();
            $table->integer('fee_amount')->nullable();
            $table->text('invoice_url')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->integer('amount');
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('status', [StatusTransactionEnum::UNPAID->value, StatusTransactionEnum::PAID->value, StatusTransactionEnum::EXPIRED->value, StatusTransactionEnum::FAILED->value, StatusTransactionEnum::REFUND->value]);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topup_agens');
    }
};
