<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('vehicles', function (Blueprint $table) {
        if (!Schema::hasColumn('vehicles', 'brand')) {
            $table->string('brand')->after('vehicle_type')->nullable();
        }
        if (!Schema::hasColumn('vehicles', 'year')) {
            $table->year('year')->after('model')->nullable();
        }
        if (!Schema::hasColumn('vehicles', 'engine_no')) {
            $table->string('engine_no')->after('year')->nullable();
        }
        if (!Schema::hasColumn('vehicles', 'chassis_no')) {
            $table->string('chassis_no')->after('engine_no')->nullable();
        }
        if (!Schema::hasColumn('vehicles', 'mileage')) {
            $table->integer('mileage')->after('chassis_no')->default(0);
        }
        if (!Schema::hasColumn('vehicles', 'fuel_type')) {
            $table->string('fuel_type')->after('mileage')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            //
        });
    }
};
