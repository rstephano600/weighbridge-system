<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('truck_visits', function (Blueprint $table) {
            $table->string('Status')->change();
        });
    }

    public function down(): void
    {
        Schema::table('truck_visits', function (Blueprint $table) {
            $table->integer('Status')->change();
        });
    }
};
