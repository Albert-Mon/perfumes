<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class municipios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->insert([
            'nombre' => 'Lerma',
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Xonacatlán',
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Toluca',
        ]);
        DB::table('municipios')->insert([
            'nombre' => 'Otzolotepec',
        ]);
    }
}
