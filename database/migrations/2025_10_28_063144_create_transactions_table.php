<?php

use App\Models\Manufacturer;
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
            $table->id();
            $table->string('code')->unique();
            $table->integer('quantity')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type',['import','export']);
            $table->text('note')->nullable();
            $table->decimal('total_amount', 15, 2)->default(0);

            $table->timestamps();// thay date
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
