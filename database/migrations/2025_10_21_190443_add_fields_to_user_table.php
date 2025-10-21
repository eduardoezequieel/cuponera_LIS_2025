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
            $table->string('lastname', 100)->nullable()->after('name');
            $table->string('username', 100)->nullable()->unique()->after('lastname');
            $table->string('dui', 9)->nullable()->after('username')->unique();
            $table->date('birth_date')->nullable()->after('dui');
            $table->string('company_name')->nullable()->after('birth_date');
            $table->string('nit')->nullable()->after('company_name')->unique();
            $table->string('address')->nullable()->after('nit');
            $table->string('phone')->nullable()->after('address');
            $table->boolean('company_approved')->default(false)->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['lastname',
            'username',
            'dui',
            'birth_date',
            'company_name',
            'nit',
            'address',
            'phone',
            'company_approved']);
        });
    }
};
