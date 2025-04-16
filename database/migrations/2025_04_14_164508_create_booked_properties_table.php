<?php

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
        Schema::create('booked_properties', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('property_id')->constrained('properties');
            $table->foreignUlid('collaborator_id')->constrained('users');
            $table->date('date'); // Ngày đặt phòng
            $table->decimal('price', 10, 2);
            $table->decimal('deposit', 10, 2)->nullable();
            $table->text('note')->nullable();
            $table->string('booking_status')->default('pending'); // pending, confirmed, cancelled, completed
            $table->string('deposit_payment_status')->default('pending'); // pending, paid, refunded
            $table->foreignUlid('customer_id')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_info')->nullable();
            $table->string('customer_cccd')->nullable(); // Cân nhắc bảo mật
            $table->json('customer_images')->nullable(); // Cân nhắc bảo mật
            // Các trường bổ sung
            $table->string('booking_code')->unique(); // Mã đặt phòng
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->integer('discount_code_id')->nullable(); // Liên kết với bảng discount_codes (nếu có)
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_properties');
    }
};
