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

    Schema::create('weighbridge_transactions', function (Blueprint $table) {
    $table->id();
    $table->string('transaction_no')->unique();

    $table->foreignId('truck_visit_id')->nullable()->constrained();
    $table->foreignId('truck_id')->nullable()->constrained();
    $table->foreignId('driver_id')->nullable()->constrained();
    $table->foreignId('material_id')->constrained();

    $table->integer('gross_weight')->nullable();
    $table->integer('tare_weight')->nullable();
    $table->integer('net_weight')->nullable();
    $table->enum('direction', ['IN', 'OUT']);

    $table->string('Status')->default('Active');
    $table->foreignId('user_id')->nullable()->constrained();

    $table->timestamps();
});


    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighbridge_transactions');
    }
};
