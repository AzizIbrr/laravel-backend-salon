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
        Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->string('id_appointment')->nullable();
        $table->unsignedBigInteger('location_id')->nullable();
        $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        $table->string('name')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->date('date')->nullable();
        $table->time('start_time')->nullable();
        $table->string('status')->nullable();
        $table->decimal('total_price', 8, 2)->nullable();
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
