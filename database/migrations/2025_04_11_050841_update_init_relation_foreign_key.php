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
        Schema::table('veterinarians', function (Blueprint $table) {
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_owners', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('clinics', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pets', function (Blueprint $table) {
            $table->foreign('pet_owner_id')->references('id')->on('pet_owners')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('breed_id')->references('id')->on('breeds')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('breeds', function (Blueprint $table) {
            $table->foreign('pet_type_id')->references('id')->on('pet_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_medications', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('medication_type_id')->references('id')->on('medication_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('medical_record_treatments', function (Blueprint $table) {
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('pet_medication_id')->references('id')->on('pet_medications')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('medical_records', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('appointment_id')->references('id')->on('appointments')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_vaccinations', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('vaccination_id')->references('id')->on('vaccinations')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('vaccinations', function (Blueprint $table) {
            $table->foreign('pet_type_id')->references('id')->on('pet_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_allergies', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('icon_id')->references('id')->on('icons')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('allergy_category_id')->references('id')->on('allergy_categories')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->foreign('pet_owner_id')->references('id')->on('pet_owners')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('service_type_id')->references('id')->on('service_types')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('appointment_schedule_id')->references('id')->on('appointment_schedules')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_medication_schedules', function (Blueprint $table) {
            $table->foreign('pet_medication_id')->references('id')->on('pet_medications')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('veterinarian_pet_types', function (Blueprint $table) {
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('pet_type_id')->references('id')->on('pet_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('service_prices', function (Blueprint $table) {
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('service_type_id')->references('id')->on('service_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('appointment_schedules', function (Blueprint $table) {
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('appointment_requests', function (Blueprint $table) {
            $table->foreign('pet_owner_id')->references('id')->on('pet_owners')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('appointment_schedule_id')->references('id')->on('appointment_schedules')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('clinic_id')->references('id')->on('clinics')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('service_veterinarian_types', function (Blueprint $table) {
            $table->foreign('service_type_id')->references('id')->on('service_types')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('online_consultation_requests', function (Blueprint $table) {
            $table->foreign('pet_owner_id')->references('id')->on('pet_owners')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('online_consultations', function (Blueprint $table) {
            $table->foreign('pet_owner_id')->references('id')->on('pet_owners')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('veterinarian_id')->references('id')->on('veterinarians')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('menu_permissions', function (Blueprint $table) {
            $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('permission_id')->references('id')->on('permissions')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('linked_social_accounts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('field_attachment_uploads', function (Blueprint $table) {
            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_weights', function (Blueprint $table) {
            $table->foreign('pet_id')->references('id')->on('pets')->cascadeOnUpdate()->restrictOnDelete();
        });

        Schema::table('pet_types', function (Blueprint $table) {
            $table->foreign('icon_id')->references('id')->on('icons')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
