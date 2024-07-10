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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pet_owner_id');
            $table->unsignedBigInteger('breed_id');
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('chip_number')->nullable();
            $table->smallInteger('weight')->nullable();
            $table->enum('gender', ['m', 'f'])->nullable();

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
        Schema::dropIfExists('pets');
    }
};
