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
    Schema::table('job_cards', function (Blueprint $table) {
        if (!Schema::hasColumn('job_cards', 'customer_complaints')) {
            $table->json('customer_complaints')->nullable()->after('mechanic_name');
        }
    });
}

    public function down()
    {
        Schema::table('job_cards', function (Blueprint $table) {
            $table->dropColumn('customer_complaints');
        });
    }
};
