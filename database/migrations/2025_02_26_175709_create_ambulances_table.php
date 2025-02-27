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
    Schema::create('ambulances', function (Blueprint $table) {
        $table->id();
        $table->string('driver_name');
        $table->string('driver_phone');
        $table->string('vehicle_number');
        $table->string('plate_number'); // Remove AFTER
        $table->string('status')->default('available');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
