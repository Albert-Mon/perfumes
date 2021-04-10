<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'nombre' => 'México',
        ]);
        DB::table('estados')->insert([
            'nombre' => 'Puebla',
        ]);
        DB::table('estados')->insert([
            'nombre' => 'Oaxaca',
        ]);
        DB::table('estados')->insert([
            'nombre' => 'Veracruz',
        ]);
    }
}
