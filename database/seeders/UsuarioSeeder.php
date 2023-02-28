<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert(
            [
                'id_trabajador'=>'1',
                'usuario'=>'EzioDiamonds',
                'contraseña'=> Hash::make('ucv123'),
            ]
        );
    }
}
