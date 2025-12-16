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
            $table->string('name');
            $table->string('type')->default('user');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->string('ssc_roll')->nullable();
            $table->string('ssc_regi')->nullable();
            $table->string('ssc_board')->nullable();
            $table->string('ssc_passing_year')->nullable();
            $table->string('ssc_gpa')->nullable();
            $table->string('ssc_out_of')->nullable();
            $table->string('hsc_roll')->nullable();
            $table->string('hsc_regi')->nullable();
            $table->string('hsc_board')->nullable();
            $table->string('hsc_passing_year')->nullable();
            $table->string('hsc_gpa')->nullable();
            $table->string('hsc_out_of')->nullable();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->foreignId('division_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('thana_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('signature_id', 2048)->nullable();
            $table->string('profile_photo_id', 2048)->nullable();
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
