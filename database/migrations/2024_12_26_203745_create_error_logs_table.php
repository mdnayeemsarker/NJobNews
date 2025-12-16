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
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('client_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->string('session_id')->nullable();
            $table->string('previous_url')->nullable();
            $table->string('query_string')->nullable();
            $table->text('headers')->nullable();
            $table->text('payload')->nullable();
            $table->text('stack_trace')->nullable();
            $table->integer('status_code')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};
