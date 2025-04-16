<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Sesuaikan jika modelnya bukan User

class TeknisiSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Teknisi',
            'email' => 'teknisi@gmail.com',
            'password' => Hash::make('AlatTeknisi13'),
            'role' => 'teknisi',
        ]);

    }
}
