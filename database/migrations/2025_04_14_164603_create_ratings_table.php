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
        Schema::create('ratings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('booked_property_id')->constrained('booked_properties'); // Đổi tên khóa ngoại
            $table->text('review')->nullable();
            $table->integer('star_quantity')->nullable();
            $table->foreignUlid('customer_id')->nullable()->constrained('customers'); // Người đánh giá (có thể là user hoặc customer)
            $table->date('rating_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
