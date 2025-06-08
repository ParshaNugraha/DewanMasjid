<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrNew(['username' => 'superadmin']);

        $user->email = 'superadmindmi@gmail.com';
        $user->password = Hash::make('password123');
        $user->role = 'superadmin';

        $user->save();

        $this->command->info('Superadmin berhasil disimpan/diupdate.');
    }
}
