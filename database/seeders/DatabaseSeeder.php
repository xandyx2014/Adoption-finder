<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Especie::factory(20)->create();
        \App\Models\Raza::factory(20)->create();
        \App\Models\Etiqueta::factory(20)->create();
    }
}
