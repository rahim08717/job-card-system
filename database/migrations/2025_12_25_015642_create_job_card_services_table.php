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
        Schema::create('job_card_services', function (Blueprint $table) {
            $table->id();

            // Link to Job Card
            $table->foreignId('job_card_id')->constrained('job_cards')->onDelete('cascade');

            // Item Details
            $table->string('service_name'); // Part name or Service description
            $table->decimal('price', 10, 2)->default(0); // Unit Price
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2)->default(0); // Auto-calculated (price * quantity)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_card_services');
    }
};
