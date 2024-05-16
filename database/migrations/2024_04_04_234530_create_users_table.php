<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['m', 'f'])->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->tinyInteger('attempt_login')->nullable();
            $table->timestamp('attempt_login_active')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->nullableMorphs('profile');
            $table->rememberToken();

            $table->timestamps();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletesTz('deleted_at', precision: 0);
            $table->string('deleted_by')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
