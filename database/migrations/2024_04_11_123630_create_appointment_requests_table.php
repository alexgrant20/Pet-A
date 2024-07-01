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
        Schema::create('appointment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_owner_id');
            $table->unsignedBigInteger('pet_id')->nullable();
            $table->unsignedBigInteger('appointment_schedule_id');
            $table->unsignedBigInteger('clinic_id');
            $table->unsignedBigInteger('appointment_type_id');
            $table->unsignedBigInteger('veterinarian_id');
            $table->date('appointment_date');
            $table->text('appointment_note')->nullable();
            $table->tinyInteger('is_accepted')->nullable();

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
        Schema::dropIfExists('appointment_requests');
    }
};
