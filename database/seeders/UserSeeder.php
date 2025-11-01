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

        $hostUser = User::create([
            'email' => 'host@gmail.com',
            'password' => Hash::make('usuario123'),
            'status' => 'activo',
            'role_id' => $hostRole->id,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now(),
        ]);

        Host::create([
            'name' => 'Organizacion Test',
            'person_full_name' => 'First Host',
            'cuit' => '12123456789',
            'linkedin' => 'https://linkedin.com',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'avatar' => 'perfil-host.svg',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit...',
            'phone' => '64934312',
            'location' => 'Buenos Aires',
            'user_id' => $hostUser->id,
            'disabled_at' => null,
            'rejection_reason' => null,
        ]);

        $volunteerUser = User::create([
            'email' => 'volunteer@gmail.com',
            'password' => Hash::make('usuario123'),
            'status' => 'activo',
            'role_id' => $volunteerRole->id,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now(),
        ]);

        Volunteer::create([
            'full_name' => 'First Volunteer',
            'dni' => '12345678',
            'phone' => '64934312',
            'linkedin' => 'https://linkedin.com',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'avatar' => 'perfil-volunteer.svg',
            'biography' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit...',
            'educational_level' => 'Postgrado',
            'profession' => 'Estudiante',
            'location' => 'Buenos Aires',
            'birthdate' => Carbon::now()->subYears(20),
            'user_id' => $volunteerUser->id,
        ]);
    }
}
