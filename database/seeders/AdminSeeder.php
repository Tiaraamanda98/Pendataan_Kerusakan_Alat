<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'nama_instansi' => 'Admin',
            'email' => 'adminhelpme@gmail.com',
            'password' => Hash::make('H3lpm3'), // Kata sandi diperbarui
            'role' => 'admin',
        ]);
    }
}
