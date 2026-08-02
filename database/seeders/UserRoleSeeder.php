<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat User Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // 2. Buat User Guest (Untuk melihat halaman publik/biodata)
        User::updateOrCreate(
            ['email' => 'guest@gmail.com'],
            [
                'name'     => 'Tamu / Guest User',
                'password' => Hash::make('password123'),
                'role'     => 'guest',
            ]
        );
    }
}
