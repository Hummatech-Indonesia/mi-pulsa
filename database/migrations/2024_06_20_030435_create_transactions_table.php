<?php

use App\Enums\StatusDigiFlazzEnum;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('blazz_id')->unique()->nullable();
            $table->string('ref_id');
            $table->string('customer_no');
            $table->integer('buyer_last_saldo')->nullable();
            $table->integer('price')->nullable();
            $table->string('tele')->nullable();
            $table->string('wa')->nullable();
            $table->string('message')->nullable();
            $table->enum('status', [StatusDigiFlazzEnum::PENDING->value, StatusDigiFlazzEnum::FAILED->value, StatusDigiFlazzEnum::SUCCESS->value])->default(StatusDigiFlazzEnum::PENDING->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
