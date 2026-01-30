<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
         [
                 'name' => 'Bolsa Reutilizable de Algodón Orgánico',
                 'key' => 'bolsa_reutilizable_algodon',
                 'stock' => 10,
                 'description' => 'Bolsa resistente y duradera hecha 100% de algodón orgánico certificado. Perfecta para tus compras diarias, reduce el uso de plástico de un solo uso. Capacidad de 10kg.',
                 'image' => 'products/bolsa-algodon.jpg',
                 'price' => 850.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ],
             [
                 'name' => 'Remera Ecológica Unisex',
                 'key' => 'remera_ecologica',
                 'stock' => 15,
                 'description' => 'Remera confeccionada con algodón orgánico y poliéster reciclado. Tinte natural sin químicos tóxicos. Diseño minimalista y cómodo para uso diario.',
                 'image' => 'products/remera-ecologica.jpg',
                 'price' => 3200.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ],
             [
                 'name' => 'Set de Cubiertos de Bambú',
                 'key' => 'set_cubiertos_bambu',
                 'stock' => 10,
                 'description' => 'Kit portable de cubiertos reutilizables hechos de bambú sostenible. Incluye tenedor, cuchillo, cuchara, pajita y estuche de tela. Ideal para llevar a la oficina o viajes.',
                 'image' => 'products/cubiertos-bambu.jpg',
                 'price' => 1450.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ],
             [
                 'name' => 'Botella Térmica de Acero Inoxidable',
                 'key' => 'botella_termica_acero',
                 'stock' => 5,
                 'description' => 'Botella reutilizable de acero inoxidable con doble pared. Mantiene bebidas frías por 24hs y calientes por 12hs. Libre de BPA. Capacidad 750ml.',
                 'image' => 'products/botella-termica.jpg',
                 'price' => 4500.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ],
             [
                 'name' => 'Pala de Jardín con Mango de Madera',
                 'key' => 'pala_jardin_madera',
                 'stock' => 3,
                 'description' => 'Herramienta de jardinería con cabezal de acero forjado y mango ergonómico de madera certificada FSC. Durable y sustentable para tu huerta urbana.',
                 'image' => 'products/pala-jardin.jpg',
                 'price' => 2800.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ],
             [
                 'name' => 'Pack 3 Paños de Cocina Biodegradables',
                 'key' => 'pack_panos_biodegradables',
                 'stock' => 20,
                 'description' => 'Paños multiuso elaborados con fibras naturales de celulosa y algodón. 100% biodegradables y compostables. Reemplazan hasta 20 rollos de papel descartable cada uno.',
                 'image' => 'products/panos-biodegradables.jpg',
                 'price' => 1200.00,
                 'created_at' => Carbon::now()->subDays(rand(1, 365)),
                 'updated_at' => Carbon::now()
             ]
         ]);
    }
}
