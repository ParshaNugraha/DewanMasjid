<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('username', 'superadmin')->exists()) {
            User::create([
                'username' => 'superadmin',
                'password' => Hash::make('password123'), // Ganti passwordnya sesuai keinginan
                'role' => 'superadmin',
            ]);
            $this->command->info('Superadmin berhasil dibuat.');
        } else {
            $this->command->info('Superadmin sudah ada.');
        }
    }
}
