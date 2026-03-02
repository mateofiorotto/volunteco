<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conditions')->insert([
            [
                'key' => 'alojamiento',
                'name' => 'Alojamiento',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'comida',
                'name' => 'Comida',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'transporte',
                'name' => 'Transporte',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'materiales_incluidos',
                'name' => 'Materiales incluidos',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'capacitacion',
                'name' => 'Capacitación',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'duracion_flexible',
                'name' => 'Duración flexible',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'trabajo_al_aire_libre',
                'name' => 'Trabajo al aire libre',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
