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
        Schema::create('drivers', function (Blueprint $table) {
            $table->foreignUuid('user_id')->primary()->constrained('users',"id")->onDelete('cascade');

            $table->enum('vehicle_type', ['CAR', 'BIKE']);
            $table->enum('status', ['AVAILABLE', 'BUSY', 'OFFLINE'])->default('OFFLINE');

            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
