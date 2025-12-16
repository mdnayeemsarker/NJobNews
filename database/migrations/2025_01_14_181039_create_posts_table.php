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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title_1')->nullable();
            $table->string('sub_title_2')->nullable();
            $table->string('thumb')->nullable();
            $table->string('thumb_caption')->nullable();
            $table->string('photo_card')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->foreignId('division_id')->nullable()->constrained('divisions')->onDelete('cascade');
            $table->foreignId('district_id')->nullable()->constrained('districts')->onDelete('cascade');
            $table->foreignId('thana_id')->nullable()->constrained('thanas')->onDelete('cascade');
            $table->boolean('is_slider')->default(false);
            $table->boolean('is_breaking')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_recommended')->default(false);
            $table->boolean('status')->default(false);
            $table->text('short_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('slug')->unique();
            $table->string('read_more_link')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('view')->default(0);
            $table->text('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
