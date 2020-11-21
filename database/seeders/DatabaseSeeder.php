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
        \App\Models\User::factory(10);
        \App\Models\User::factory(1)->create(
            [
                'email' => 'xandyx2014@gmail.com'
            ]
        );
        \App\Models\Especie::factory(20)->create();
        \App\Models\Raza::factory(20)->create();
        \App\Models\Etiqueta::factory(20)->create();
        \App\Models\TipoDenuncia::factory(20)->create();
        \App\Models\TipoPublicacion::factory(20)->create();
        \App\Models\PublicacionInformativa::factory(20)
            ->hasImagens(1)
            ->hasDenuncias(5)->create();
    }
}
