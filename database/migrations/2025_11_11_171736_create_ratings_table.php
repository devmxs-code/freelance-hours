<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('rated_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->tinyInteger('rating')->unsigned(); // 1-5
            $table->text('comment')->nullable();
            $table->string('type')->default('project'); // project, user
            $table->timestamps();

            $table->index(['project_id', 'user_id']);
            $table->index(['rated_user_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
