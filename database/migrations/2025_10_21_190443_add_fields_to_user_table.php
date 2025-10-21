<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname', 100)->default('')->after('name');
            $table->string('username', 100)->default('')->unique()->after('lastname');
            $table->string('dui', 9)->default('')->after('username')->unique();
            $table->date('birth_date')->nullable()->after('dui');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname', 'username', 'dui', 'birth_date']);
        });
    }
};
