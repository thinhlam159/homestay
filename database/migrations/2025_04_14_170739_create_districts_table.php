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
        Schema::create('districts', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('province_id')->constrained('provinces'); // Liên kết với bảng provinces
            $table->string('name'); // Tên quận/huyện
            $table->string('code')->unique()->nullable(); // Mã quận/huyện (nếu có)
            $table->timestamps();

            $table->unique(['province_id', 'name']); // Đảm bảo tên quận/huyện là duy nhất trong mỗi tỉnh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
