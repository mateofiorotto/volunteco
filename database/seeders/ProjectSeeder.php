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
            ["Reforestación Urbana", "Proyecto enfocado en plantar especies nativas en zonas urbanas para mejorar la calidad del aire y restaurar espacios verdes comunitarios."],
            ["Limpieza de Costas y Ríos", "Actividad de restauración ambiental para recolectar residuos en zonas costeras y cursos de agua afectados por contaminación humana."],
            ["Huertas Comunitarias Sostenibles", "Creación de huertas orgánicas en barrios con el fin de promover alimentación saludable y educación ambiental."],
            ["Protección de Especies Nativas", "Programa de conservación para monitorear y proteger especies de flora y fauna en peligro dentro de áreas naturales."],
            ["Restauración de Bosques Degradados", "Reforestación de zonas degradadas por incendios o tala ilegal mediante la plantación de árboles autóctonos."],
            ["Educación Ambiental en Escuelas", "Charlas y talleres para niños y jóvenes sobre reciclaje, biodiversidad y cuidado del medio ambiente."],
            ["Monitoreo de Aves Migratorias", "Actividad orientada al registro, conteo y estudio de aves migratorias en reservas naturales locales."],
            ["Creación de Reservas Polinizadoras", "Instalación de jardines con plantas nativas para fomentar la presencia de abejas y otros polinizadores esenciales."],
            ["Campaña de Reciclaje Barrial", "Iniciativa para enseñar a vecinos sobre separación de residuos e implementar puntos verdes en la comunidad."],
            ["Limpieza de Senderos Naturales", "Mantenimiento y limpieza de rutas de trekking para preservar ecosistemas y evitar acumulación de residuos."],
            ["Construcción de Composteras Comunitarias", "Proyecto para fabricar composteras y capacitar a la comunidad en el manejo responsable de residuos orgánicos."],
            ["Restauración de Humedales", "Acciones destinadas a limpiar, monitorear y restaurar humedales afectados por contaminación y sequía."],
            ["Censo de Biodiversidad Local", "Proyecto científico que registra especies animales y vegetales para evaluar la salud de ecosistemas urbanos."],
            ["Recolección de Plásticos del Océano", "Jornadas de voluntariado para retirar plásticos y microplásticos en zonas costeras y marítimas."],
            ["Creación de Parques Educativos", "Diseño de espacios educativos al aire libre para promover el aprendizaje sobre ecología y sostenibilidad."],
            ["Protección de Arroyos y Manantiales", "Tareas de preservación y limpieza para prevenir contaminación y garantizar agua limpia en zonas rurales."],
            ["Talleres de Energías Renovables", "Capacitación a comunidades sobre paneles solares, energía eólica y tecnologías verdes."],
            ["Recuperación de Suelos Contaminados", "Técnicas de remediación ecológica para restaurar suelos afectados por desechos industriales."],
            ["Mantenimiento de Áreas Protegidas", "Cuidado general de reservas naturales, incluyendo control de especies invasoras y señalización educativa."],
            ["Restauración de Playas Naturales", "Actividades de voluntariado para recuperar playas afectadas por residuos y erosión costera."]
        ];

        for ($i = 0; $i < 20; $i++) {

            // Fechas realistas
            $start = Carbon::now()->addDays(rand(1, 60));
            $end   = (clone $start)->addDays(rand(7, 60));

            Project::create([
                'enabled' => (bool) rand(0, 1), // Ahora puede ser true o false
                'title' => $projects[$i][0],
                'description' => $projects[$i][0] . ". " . $projects[$i][1],
                'image' => null,
                'start_date' => $start,
                'end_date' => $end,
                'location_id' => rand(1, 3921),
                'work_hours_per_day' => $workHours[array_rand($workHours)],
                'project_type_id' => rand(1, 2),
                'host_id' => rand(1, 10),
            ]);
        }
    }
}
