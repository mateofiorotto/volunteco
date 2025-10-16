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
        //crear un usuario
        DB::table('users')->insert([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => 'Activo',
            'role_id' => 1,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'updated_at' => Carbon::now()
        ]);
    }
}
