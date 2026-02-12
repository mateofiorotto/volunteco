<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear un usuario. ID 1
        DB::table('project_types')->insert([
            [
                'key' => 'reforestacion', // separado_con_guion
                'name' => 'Reforestación',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'construccion_de_invernadero',
                'name' => 'Construcción de invernadero',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
