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
        Schema::create('manufacturers', function (Blueprint $table) {
             $table->id();
            $table->string('name'); // Tên nhà sản xuất
            $table->string('email')->nullable(); // Email liên hệ
            $table->string('phone')->nullable(); // Số điện thoại
            $table->string('address')->nullable(); // Địa chỉ
            $table->text('description')->nullable(); // Mô tả thêm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->dropColumn('manufacturers');
        });
    }
};
