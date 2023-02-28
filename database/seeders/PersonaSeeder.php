<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personas')->insert(
            [
                'dni_persona' => '70880112',
                'nombres'=> 'Dumas Darwin',
                'apellidos' => 'Ponte Huamán',
                'celular' => '928602031',
                'direccion' => 'Urb. Casuarinas'
            ]
            );
    }
}
