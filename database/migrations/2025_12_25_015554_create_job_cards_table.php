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
        Schema::create('job_cards', function (Blueprint $table) {
            $table->id();

            // Auto-generated Job ID (e.g., JOB-1001)
            $table->string('job_card_no')->unique();

            // Link to Vehicle
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');

            // Date & Time
            $table->dateTime('entry_date_time');
            $table->date('expected_delivery_date')->nullable();

            // Job Status
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Delivered'])->default('Pending');

            $table->string('mechanic_name')->nullable();

            // [IMPORTANT] JSON Columns for Dynamic Requirements
            $table->json('customer_complaints')->nullable(); // Example: ["Brake issue", "AC not cooling"]
            $table->json('inspection_checklist')->nullable(); // Example: {"lights": "ok", "horn": "bad"}

            // Final Bill
            $table->decimal('grand_total', 10, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_cards');
    }
};
