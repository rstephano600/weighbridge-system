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
        Schema::create('weighbridge_readings', function (Blueprint $table) {
    $table->id();
    $table->string('indicator_id');
    $table->integer('weight');
    $table->string('unit', 10);
    $table->boolean('stable');
    $table->timestamp('reading_time');
    $table->timestamps();

    $table->index('indicator_id');
});

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighbridge_readings');
    }
};
