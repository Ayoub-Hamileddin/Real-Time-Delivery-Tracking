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
        Schema::create('delivery_tasks', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("driver_id")
                ->constrained("drivers","user_id")
                ->onDelete("cascade");

            $table->foreignUuid("order_id")
                ->constrained("orders","id")
                ->onDelete("cascade");

            $table->enum('status', ['Pending', 'Picked_up', 'In_transit', 'Delivered', 'Failed'])->default('Pending');

            
            $table->decimal('pickup_latitude', 10, 8);
            $table->decimal('pickup_longitude', 11, 8);
            $table->decimal('dropoff_latitude', 10, 8);
            $table->decimal('dropoff_longitude', 11, 8);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_tasks');
    }
};
