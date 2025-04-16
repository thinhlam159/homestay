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
        Schema::create('properties', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('owner_id')->constrained('users');
            $table->foreignUlid('category_id')->constrained('categories');
            $table->string('name');
            $table->string('property_type')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->json('images')->nullable();
            $table->json('videos')->nullable();
            $table->text('rule')->nullable();
            $table->json('service')->nullable();
            $table->json('amenities')->nullable();
            $table->integer('room_quantity')->nullable();
            $table->integer('standard_people_quantity')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_popular')->default(0);
            $table->tinyInteger('is_discounted')->default(0);
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();
            $table->decimal('deposit_percentage', 5, 2)->nullable();
            $table->text('cancellation_policy')->nullable();
            $table->timestamps();
            $table->softDeletes();
//            location_id hoặc province_id, district_id, ward_id: Để quản lý vị trí địa lý chi tiết. Cần tạo bảng Provinces, Districts, Wards nếu muốn quản lý địa chỉ theo cấp bậc hành chính.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
