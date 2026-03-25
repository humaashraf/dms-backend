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
        Schema::table('users', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('name');
            $table->string('username')->unique()->nullable()->after('last_name');
            $table->string('phone')->nullable()->after('username');
            $table->enum('type', ['staff', 'user'])->default('staff')->after('phone');
            $table->tinyInteger('status')->default(0)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'username', 'phone', 'type', 'status']);
        });
    }
};
