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
        Schema::create('sms_workers', function (Blueprint $table) {
            $table->id();
            $table->string('receiver');
            $table->string('body');
            $table->string('body_second')->nullable();
            $table->string('sender')->default('01517851911');
            $table->string('first_sms')->nullable();
            $table->string('second_sms')->nullable();
            $table->string('third_sms')->nullable();
            $table->enum('status', ['create', 'sent', 'paid', 'wait', 'complete'])->default('create');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_workers');
    }
};
