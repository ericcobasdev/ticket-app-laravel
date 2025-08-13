<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios por rol
        $usuarios = User::where('role', 'usuario')->get();
        $tecnicos = User::where('role', 'tecnico')->get();

        foreach ($usuarios as $usuario) {
            Ticket::factory()->count(3)->create([
                'user_id' => $usuario->id,
                'assigned_to' => $tecnicos->random()->id ?? null, // Asignar técnico aleatorio o dejar null
            ]);
        }
    }
}