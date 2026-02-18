<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Volunteer;
use App\Models\Host;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('type', 'admin')->first();
        $hostRole = Role::where('type', 'host')->first();
        $volunteerRole = Role::where('type', 'volunteer')->first();

        if (!$hostRole || !$adminRole || !$volunteerRole) {
            $this->command->error('Rol no encontrado.');
            return;
        }

        $admin = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'activo',
            'role_id' => $adminRole->id,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now(),
        ]);


        $hostsData = [
            [
                'email' => 'contact@verdevida.com',
                'name' => 'Verde vida',
                'person_full_name' => 'María Fernández',
                'cuit' => '20345678911',
                'social' => 'https://linkedin.com/in/mariafernandez',
                'phone' => '1123456789',
            ],
            [
                'email' => 'contact@ecoenergia.com',
                'name' => 'EcoEnergía',
                'person_full_name' => 'Carlos Gómez',
                'cuit' => '20345678912',
                'social' => 'https://facebook.com/ecoenergia',
                'phone' => '1123456790',
            ],
            [
                'email' => 'contact@reforestando.com',
                'name' => 'Reforestando',
                'person_full_name' => 'Lucía Martínez',
                'cuit' => '20345678913',
                'social' => 'https://instagram.com/reforestando',
                'phone' => '1123456791',
            ],
            [
                'email' => 'contact@sustentable.com',
                'name' => 'Sustentable S.A.',
                'person_full_name' => 'Diego Ramírez',
                'cuit' => '20345678914',
                'social' => 'https://linkedin.com/in/diegoramirez',
                'phone' => '1123456792',
            ],
            [
                'email' => 'contact@bioplaneta.com',
                'name' => 'BioPlaneta',
                'person_full_name' => 'Sofía López',
                'cuit' => '20345678915',
                'social' => 'https://facebook.com/bioplaneta',
                'phone' => '1123456793',
            ],
            [
                'email' => 'contact@ecohogar.com',
                'name' => 'EcoHogar',
                'person_full_name' => 'Martín Díaz',
                'cuit' => '20345678916',
                'social' => 'https://instagram.com/ecohogar',
                'phone' => '1123456794',
            ],
            [
                'email' => 'contact@naturalezaactiva.com',
                'name' => 'Naturaleza activa',
                'person_full_name' => 'Valentina Torres',
                'cuit' => '20345678917',
                'social' => 'https://linkedin.com/in/valentinatorres',
                'phone' => '1123456795',
            ],
            [
                'email' => 'contact@bioexperiencias.com',
                'name' => 'BioExperiencias',
                'person_full_name' => 'Julián Castro',
                'cuit' => '20345678918',
                'social' => 'https://facebook.com/bioexperiencias',
                'phone' => '1123456796',
            ],
            [
                'email' => 'contact@aventuraverde.com',
                'name' => 'Aventura verde',
                'person_full_name' => 'Camila Rojas',
                'cuit' => '20345678919',
                'social' => 'https://instagram.com/aventuraverde',
                'phone' => '1123456797',
            ],
            [
                'email' => 'contact@innovaeco.com',
                'name' => 'InnovaEco',
                'person_full_name' => 'Fernando Pérez',
                'cuit' => '20345678920',
                'social' => 'https://linkedin.com/in/fernandoperez',
                'phone' => '1123456798',
            ],
        ];

        $statuses = ['activo', 'pendiente', 'inactivo'];

        foreach ($hostsData as $hostData) {
            $hostUser = User::create([
                'email' => $hostData['email'],
                'password' => Hash::make('12345678'),
                'status' => $statuses[array_rand($statuses)], // Aleatorio: activo, pendiente, inactivo
                'role_id' => $hostRole->id,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now(),
            ]);

            Host::create([
                'name' => $hostData['name'],
                'person_full_name' => $hostData['person_full_name'],
                'cuit' => $hostData['cuit'],
                'linkedin' => $hostData['social'], // si es otra red social, se puede ajustar aquí
                'facebook' => null,
                'instagram' => null,
                'description' => 'Empresa dedicada a promover prácticas ecológicas y sostenibles.',
                'phone' => $hostData['phone'],
                'location_id' => rand(1, 3921), // ID aleatorio entre 1 y 3921
                'user_id' => $hostUser->id,
            ]);
        }


        $volunteersData = [
            [
                'name' => 'Ana',
                'lastname' => 'Gómez',
                'dni' => '12345678',
                'phone' => '1123456781',
                'social' => 'https://linkedin.com/in/anagomez',
                'biography' => 'Apasionada por la ecología y el cuidado del medio ambiente, con experiencia en proyectos comunitarios y voluntariados locales para preservar la naturaleza.',
                'educational_level' => 'Universitario',
                'profession' => 'Bióloga',
                'birthdate' => '1995-03-12',
            ],
            [
                'name' => 'Carlos',
                'lastname' => 'Ramírez',
                'dni' => '23456789',
                'phone' => '1123456782',
                'social' => 'https://facebook.com/carlosramirez',
                'biography' => 'Voluntario comprometido con la educación ambiental, ha participado en campañas de reciclaje y concienciación sobre sostenibilidad urbana.',
                'educational_level' => 'Secundario',
                'profession' => 'Profesor',
                'birthdate' => '1990-06-20',
            ],
            [
                'name' => 'Lucía',
                'lastname' => 'Martínez',
                'dni' => '34567890',
                'phone' => '1123456783',
                'social' => 'https://instagram.com/luciamartinez',
                'biography' => 'Con experiencia en gestión de proyectos ecológicos y conservación de espacios verdes, busca contribuir activamente en iniciativas sostenibles.',
                'educational_level' => 'Universitario',
                'profession' => 'Ingeniera ambiental',
                'birthdate' => '1992-11-05',
            ],
            [
                'name' => 'Diego',
                'lastname' => 'Pérez',
                'dni' => '45678901',
                'phone' => '1123456784',
                'social' => 'https://linkedin.com/in/diegoperez',
                'biography' => 'Entusiasta del voluntariado ambiental, participa en campañas de limpieza de ríos y educación sobre el reciclaje en comunidades locales.',
                'educational_level' => 'Universitario',
                'profession' => 'Ambientólogo',
                'birthdate' => '1988-07-15',
            ],
            [
                'name' => 'Sofía',
                'lastname' => 'López',
                'dni' => '56789012',
                'phone' => '1123456785',
                'social' => 'https://facebook.com/sofialopez',
                'biography' => 'Apasionada por la protección de especies y conservación del ecosistema, con experiencia en proyectos educativos para niños y jóvenes.',
                'educational_level' => 'Secundario',
                'profession' => 'Educadora',
                'birthdate' => '1997-01-22',
            ],
            [
                'name' => 'Martín',
                'lastname' => 'Díaz',
                'dni' => '67890123',
                'phone' => '1123456786',
                'social' => 'https://instagram.com/martindiaz',
                'biography' => 'Voluntario activo en campañas de sensibilización ambiental y actividades al aire libre, comprometido con la sostenibilidad y el reciclaje.',
                'educational_level' => 'Universitario',
                'profession' => 'Biólogo',
                'birthdate' => '1993-09-30',
            ],
            [
                'name' => 'Valentina',
                'lastname' => 'Torres',
                'dni' => '78901234',
                'phone' => '1123456787',
                'social' => 'https://linkedin.com/in/valentinatorres',
                'biography' => 'Con experiencia en voluntariados internacionales enfocados en la protección de la biodiversidad y educación ambiental.',
                'educational_level' => 'Universitario',
                'profession' => 'Ingeniera forestal',
                'birthdate' => '1991-05-10',
            ],
            [
                'name' => 'Julián',
                'lastname' => 'Castro',
                'dni' => '89012345',
                'phone' => '1123456788',
                'social' => 'https://facebook.com/juliancastro',
                'biography' => 'Participa activamente en proyectos de reforestación y educación sobre hábitos sostenibles en la comunidad local.',
                'educational_level' => 'Secundario',
                'profession' => 'Técnico Ambiental',
                'birthdate' => '1994-12-02',
            ],
            [
                'name' => 'Camila',
                'lastname' => 'Rojas',
                'dni' => '90123456',
                'phone' => '1123456789',
                'social' => 'https://instagram.com/camilarojas',
                'biography' => 'Voluntaria dedicada a proyectos de conservación de flora y fauna, educación ambiental y campañas de limpieza de espacios públicos.',
                'educational_level' => 'Universitario',
                'profession' => 'Ecóloga',
                'birthdate' => '1996-04-18',
            ],
            [
                'name' => 'Fernando',
                'lastname' => 'Pérez',
                'dni' => '01234567',
                'phone' => '1123456790',
                'social' => 'https://linkedin.com/in/fernandoperez',
                'biography' => 'Apasionado por la sostenibilidad urbana y proyectos de voluntariado ecológico, con experiencia en gestión de residuos y educación comunitaria.',
                'educational_level' => 'Universitario',
                'profession' => 'Ingeniero ambiental',
                'birthdate' => '1990-08-25',
            ],
        ];

        foreach ($volunteersData as $volData) {
            $volUser = User::create([
                'email' => strtolower($volData['name'] . '.' . $volData['lastname']) . '@example.com',
                'password' => Hash::make('12345678'),
                'status' => $statuses[array_rand($statuses)],
                'role_id' => $volunteerRole->id, // Asumiendo que tienes un rol específico para voluntarios
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now(),
            ]);

            $volunteer = Volunteer::create([
                'name' => $volData['name'],
                'lastname' => $volData['lastname'],
                'dni' => $volData['dni'],
                'phone' => $volData['phone'],
                'linkedin' => $volData['social'], // solo una red social por voluntario
                'facebook' => null,
                'instagram' => null,
                'avatar' => null,
                'biography' => $volData['biography'],
                'educational_level' => $volData['educational_level'],
                'profession' => $volData['profession'],
                'location_id' => rand(1, 3921),
                'birthdate' => $volData['birthdate'],
                'user_id' => $volUser->id,
            ]);
        }

    }
}
