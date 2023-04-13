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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('name')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender', ['MALE', 'FEMALE', 'MISC'])->nullable();
            $table->boolean('subscribed')->default(false);
            $table->enum('theme', ['LIGHT', 'DARK'])->nullable();
            $table->boolean('notifications_set')->nullable();
            $table->boolean('localisation_set')->nullable();
            $table->boolean('explanation_shown')->nullable();
            $table->boolean('data_shown')->nullable();
            $table->boolean('bonus_info_shown')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
