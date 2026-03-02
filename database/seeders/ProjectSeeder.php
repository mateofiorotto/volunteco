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
        $workHours = ['2 Horas', '4 Horas', '6 Horas', '8 Horas'];

        $projects = [
            ["Reforestación urbana", "Proyecto enfocado en plantar especies nativas en zonas urbanas para mejorar la calidad del aire y restaurar espacios verdes comunitarios.", 1],
            ["Limpieza de costas y ríos", "Actividad de restauración ambiental para recolectar residuos en zonas costeras y cursos de agua afectados por contaminación humana.", 2],
            ["Huertas comunitarias sostenibles", "Creación de huertas orgánicas en barrios con el fin de promover alimentación saludable y educación ambiental.", 4],
            ["Protección de especies nativas", "Programa de conservación para monitorear y proteger especies de flora y fauna en peligro dentro de áreas naturales.", 3],
            ["Restauración de bosques degradados", "Reforestación de zonas degradadas por incendios o tala ilegal mediante la plantación de árboles autóctonos.", 1],
            ["Educación ambiental en escuelas", "Charlas y talleres para niños y jóvenes sobre reciclaje, biodiversidad y cuidado del medio ambiente.", 5],
            ["Monitoreo de aves migratorias", "Actividad orientada al registro, conteo y estudio de aves migratorias en reservas naturales locales.", 3],
            ["Creación de reservas polinizadoras", "Instalación de jardines con plantas nativas para fomentar la presencia de abejas y otros polinizadores esenciales.", 3],
            ["Campaña de reciclaje barrial", "Iniciativa para enseñar a vecinos sobre separación de residuos e implementar puntos verdes en la comunidad.", 2],
            ["Limpieza de senderos naturales", "Mantenimiento y limpieza de rutas de trekking para preservar ecosistemas y evitar acumulación de residuos.", 2],
            ["Construcción de composteras comunitarias", "Proyecto para fabricar composteras y capacitar a la comunidad en el manejo responsable de residuos orgánicos.", 2],
            ["Restauración de humedales", "Acciones destinadas a limpiar, monitorear y restaurar humedales afectados por contaminación y sequía.", 1],
            ["Censo de biodiversidad local", "Proyecto científico que registra especies animales y vegetales para evaluar la salud de ecosistemas urbanos.", 3],
            ["Recolección de plásticos del océano", "Jornadas de voluntariado para retirar plásticos y microplásticos en zonas costeras y marítimas.", 2],
            ["Creación de parques educativos", "Diseño de espacios educativos al aire libre para promover el aprendizaje sobre ecología y sostenibilidad.", 4],
            ["Protección de arroyos y manantiales", "Tareas de preservación y limpieza para prevenir contaminación y garantizar agua limpia en zonas rurales.", 4],
            ["Talleres de energías renovables", "Capacitación a comunidades sobre paneles solares, energía eólica y tecnologías verdes.", 5],
            ["Recuperación de suelos contaminados", "Técnicas de remediación ecológica para restaurar suelos afectados por desechos industriales.", 1],
            ["Mantenimiento de áreas protegidas", "Cuidado general de reservas naturales, incluyendo control de especies invasoras y señalización educativa.", 3],
            ["Restauración de playas naturales", "Actividades de voluntariado para recuperar playas afectadas por residuos y erosión costera.", 1]
        ];

        foreach ($projects as $project) {

            // Fechas realistas
            $start = Carbon::now()->addDays(rand(1, 60));
            $end   = (clone $start)->addDays(rand(7, 60));

            Project::create([
                'enabled' => (bool) rand(0, 1), // Ahora puede ser true o false
                'title' => $project[0],
                'description' => $project[0] . ". " . $project[1],
                'image' => null,
                'start_date' => $start,
                'end_date' => $end,
                'location_id' => rand(1, 3921),
                'work_hours_per_day' => $workHours[array_rand($workHours)],
                'project_type_id' => $project[2],
                'host_id' => rand(1, 10),
            ]);
        }
    }
}
