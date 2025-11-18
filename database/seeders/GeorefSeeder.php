<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Location;
use Illuminate\Support\Facades\Http;

class GeorefSeeder extends Seeder
{
    public function run(): void
    {

        //avisar que se esta importando
        $this->command->info('Importando provincias y localidades de Georef. Esto puede tardar unos minutos.');

        //importar provincias
        $response = Http::withOptions(['verify' => false])
            ->timeout(60)
            ->get('https://apis.datos.gob.ar/georef/api/provincias', [
                'campos' => 'id,nombre',
                'max' => 100
            ]);

        if (!$response->successful()) {
            $this->command->error('Error al obtener provincias de GEOREF');
            return;
        }

        $provinces = $response->json()['provincias'] ?? [];

        foreach ($provinces as $prov) {
            Province::firstOrCreate(['name' => $prov['nombre']]);
        }

        //localidades x provincia
        $allProvinces = Province::all();

        foreach ($allProvinces as $province) {
            $response = Http::withOptions(['verify' => false])
                ->timeout(60)
                ->get('https://apis.datos.gob.ar/georef/api/localidades', [
                    'provincia' => $province->name,
                    'campos' => 'id,nombre',
                    'max' => 5000,
                    'orden' => 'nombre'
                ]);

            if (!$response->successful()) {
                $this->command->warn("Error al obtener localidades de {$province->name}");
                continue;
            }

            $locations = $response->json()['localidades'] ?? [];

            foreach ($locations as $loc) {
                Location::firstOrCreate([
                    'name' => $loc['nombre'],
                    'province_id' => $province->id
                ]);
            }
        }
    }
}
