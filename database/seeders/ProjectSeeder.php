<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Aquí deberías obtener ids existentes
        $projectTypeId = 1; // Cambia por un ID válido de project_types
        $hostId = 1;        // Cambia por un ID válido de hosts

        $project1 = Project::create([
            'title' => 'Proyecto Comunidad Verde',
            'description' => 'Proyecto destinado a la reforestación y mantenimiento de áreas verdes en la ciudad.',
            'image' => 'thumbnail-proyecto.jpg',
            'start_date' => Carbon::now()->subDays(30),
            'end_date' => Carbon::now()->addMonths(3),
            'location' => 'Buenos Aires',
            'work_hours_per_day' => '2 Horas',
            'enabled' => true,
            'project_type_id' => $projectTypeId,
            'host_id' => $hostId,
        ]);

        $project2 = Project::create([
            'title' => 'Campaña de Donación de Alimentos',
            'description' => 'Recolección y distribución de alimentos para personas en situación de vulnerabilidad.',
            'image' => 'thumbnail-proyecto.jpg',
            'start_date' => Carbon::now()->subDays(10),
            'end_date' => Carbon::now()->addMonths(1),
            'location' => 'Rosario',
            'work_hours_per_day' => '2 Horas',
            'enabled' => true,
            'project_type_id' => $projectTypeId,
            'host_id' => $hostId,
        ]);

        // Asignar condiciones a los proyectos
        $project1->conditions()->attach([1, 2]);
        $project2->conditions()->attach([1]);
    }
}
