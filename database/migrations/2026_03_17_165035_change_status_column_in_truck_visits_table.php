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
        Schema::table('truck_visits', function (Blueprint $table) {
            $table->string('direction')->default("IN")->after('driver_id');
            $table->string('Status')->change()->default("Active");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('truck_visits', function (Blueprint $table) {
            //
        });
    }
};
