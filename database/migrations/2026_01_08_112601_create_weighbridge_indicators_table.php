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
    Schema::create('weighbridge_indicators', function (Blueprint $table) {
    $table->id();
    $table->string('indicator_id')->unique();
    $table->string('ip_address');
    $table->integer('port');
    $table->boolean('active')->default(true);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighbridge_indicators');
    }
};
