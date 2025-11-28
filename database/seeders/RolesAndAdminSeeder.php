<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'empresa', 'cliente'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $adminEmail = env('ADMIN_EMAIL', 'admin@admin.com');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        $admin = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Eduardo',
                'lastname' => 'López',
                'username' => 'eduardoezequieel',
                'dui' => '064966412',
                'birth_date' => '2003-04-24',
                'password' => Hash::make($adminPassword),
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        // Empresa por defecto
        $empresa = User::firstOrCreate(
            ['email' => 'empresa@empresa.com'],
            [
                'name' => 'Empresa Demo',
                'company_name' => 'Empresa Demo',
                'nit' => '0614-290465-101-3',
                'phone' => '77778888',
                'address' => 'San Salvador, El Salvador',
                'company_approved' => true,
                'password' => Hash::make('empresa123'),
            ]
        );
        if (!$empresa->hasRole('empresa')) {
            $empresa->assignRole('empresa');
        }
    }
}
