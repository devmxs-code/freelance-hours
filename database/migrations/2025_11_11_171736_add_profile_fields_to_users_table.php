<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable()->after('email');
            $table->string('phone')->nullable()->after('bio');
            $table->string('location')->nullable()->after('phone');
            $table->string('website')->nullable()->after('location');
            $table->json('skills')->nullable()->after('avatar');
            $table->decimal('hourly_rate', 10, 2)->nullable()->after('skills');
            $table->string('company')->nullable()->after('hourly_rate');
            $table->text('experience')->nullable()->after('company');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'bio',
                'phone',
                'location',
                'website',
                'skills',
                'hourly_rate',
                'company',
                'experience',
            ]);
        });
    }
};
