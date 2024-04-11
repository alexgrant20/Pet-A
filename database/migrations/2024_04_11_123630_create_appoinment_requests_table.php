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
        Schema::create('appoinment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_owner_id');
            $table->unsignedBigInteger('appoinment_schedule_id');
            $table->unsignedBigInteger('clinic_id');
            $table->unsignedBigInteger('appoinment_type_id');
            $table->unsignedBigInteger('veterinarian_id');
            $table->boolean('is_accepted')->default(false);

            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletesTz('deleted_at', precision: 0);
            $table->string('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appoinment_requests');
    }
};
