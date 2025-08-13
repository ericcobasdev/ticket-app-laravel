<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    
        User::create([
            'name' => 'Técnico Juan',
            'email' => 'tecnico@example.com',
            'password' => Hash::make('password'),
            'role' => 'tecnico',
        ]);
    
        User::create([
            'name' => 'Cliente Carlos',
            'email' => 'usuario@example.com',
            'password' => Hash::make('password'),
            'role' => 'usuario',
        ]);
    }
}



