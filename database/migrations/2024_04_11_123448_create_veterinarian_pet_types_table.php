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
        Schema::create('veterinarian_pet_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veterinarian_id');
            $table->unsignedBigInteger('pet_type_id');
            $table->unique(['pet_type_id', 'veterinarian_id'], 'vet_pet_type_unique');

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
        Schema::dropIfExists('veterinarian_pet_types');
    }
};
