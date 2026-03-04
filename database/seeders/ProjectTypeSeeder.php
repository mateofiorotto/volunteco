<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\ProjectType;

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
                'key' => 'restauracion',
                'name' => 'Restauración',
                'color' => '#16A34A',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'residuos',
                'name' => 'Residuos',
                'color' => '#6B7280',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'biodiversidad',
                'name' => 'Biodiversidad',
                'color' => '#059669',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'agricultura',
                'name' => 'Agricultura',
                'color' => '#CA8A04',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                'key' => 'educacion',
                'name' => 'Educación',
                'color' => '#2563EB',
                'enabled' => true,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
