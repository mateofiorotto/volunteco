<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crear un usuario. ID 1
        DB::table('users')->insert([
            [
                //id 1
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'status' => 'Activo',
                'role_id' => 1,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                //id 2
                'email' => 'host@gmail.com',
                'password' => Hash::make('usuario123'),
                'status' => 'Pendiente',
                'role_id' => 2,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ],
            [
                //id 3
                'email' => 'volunteer@gmail.com',
                'password' => Hash::make('usuario123'),
                'status' => 'Activo',
                'role_id' => 3,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('hosts')->insert([
            'name' => 'Organizacion Test',
            'person_full_name' => 'First Host',
            'cuit' => '12123456789',
            'linkedin' => 'https://linkedin.com',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'avatar' => 'avatar.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa cumque, sint quis, beatae officia repellendus possimus error deleniti impedit ipsum earum ut obcaecati nam eveniet! Nostrum, suscipit voluptate. Cupiditate quidem iste omnis temporibus nam blanditiis consequatur similique fugit dolor est non sint odit vel autem doloremque esse veritatis deleniti, quae ex recusandae vitae cum totam architecto odio! Quaerat, rerum error',
            'phone' => '64934312',
            'location' => 'Buenos Aires',
            'user_id' => 2,
            'disabled_at' => null,
            'rejection_reason' => null,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now()
        ]);

        DB::table('volunteers')->insert([
            'full_name' => 'First Volunteer',
            'dni' => '12345678',
            'phone' => '64934312',
            'linkedin' => 'https://linkedin.com',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'avatar' => 'avatar.jpg',
            'biography' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa cumque, sint quis, beatae officia repellendus possimus error deleniti impedit ipsum earum ut obcaecati nam eveniet! Nostrum, suscipit voluptate. Cupiditate quidem iste omnis temporibus nam blanditiis consequatur similique fugit dolor est non sint odit vel autem doloremque esse veritatis deleniti, quae ex recusandae vitae cum totam architecto odio! Quaerat, rerum error',
            'educational_level' => 'Postgrado',
            'profession' => 'Estudiante',
            'location' => 'Buenos Aires',
            'birthdate' => Carbon::now()->subYears(20), //20 años
            'user_id' => 3,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now()
        ]);
    }
}
