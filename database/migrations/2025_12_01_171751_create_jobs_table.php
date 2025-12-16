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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('apply_value');
            $table->string('salary')->nullable();
            $table->string('vacancy')->nullable();
            $table->string('company')->nullable();
            $table->string('educational')->nullable();
            $table->string('experience')->nullable();
            $table->string('additional')->nullable();
            $table->enum('type', ['full-time', 'part-time', 'contract'])->default('full-time');
            $table->enum('gender', ['male', 'female', 'both', 'other'])->default('other');
            $table->enum('apply', ['url', 'email', 'in-person', 'address']);
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('set null');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('thana_id')->nullable()->constrained('thanas')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('location')->nullable();
            $table->string('source_link')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
