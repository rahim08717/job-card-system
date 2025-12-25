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
        // 1. Customers Table
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique(); // Unique mobile to avoid duplicates
            $table->text('address');
            $table->timestamps();
        });

        // 2. Vehicles Table
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            // Link to Customer (Foreign Key)
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');

            $table->string('vehicle_number')->unique(); // License Plate (Unique)
            $table->string('vehicle_type'); // e.g., Car, Bike
            $table->string('brand'); // e.g., Toyota
            $table->string('model'); // e.g., Corolla
            $table->year('year');
            $table->string('engine_no');
            $table->string('chassis_no')->nullable(); // Optional
            $table->string('fuel_type'); // Petrol, Diesel, CNG
            $table->integer('mileage')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_and_vehicles_tables');
    }
};
