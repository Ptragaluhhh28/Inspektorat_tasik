<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin default
        AdminUser::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@pkl-kominfo.com',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // Admin tambahan
        AdminUser::create([
            'name' => 'Operator Kominfo',
            'username' => 'operator',
            'email' => 'operator@pkl-kominfo.com',
            'password' => Hash::make('operator123'),
            'role' => 'admin',
            'is_active' => true,
        ]);
    }
}
