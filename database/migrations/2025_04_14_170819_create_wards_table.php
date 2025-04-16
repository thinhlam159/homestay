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
        Schema::create('wards', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('district_id')->constrained('districts'); // Liên kết với bảng districts
            $table->string('name'); // Tên phường/xã
            $table->string('code')->unique()->nullable(); // Mã phường/xã (nếu có)
            $table->timestamps();

            $table->unique(['district_id', 'name']); // Đảm bảo tên phường/xã là duy nhất trong mỗi quận/huyện
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
