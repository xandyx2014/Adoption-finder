<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        \App\Models\Perfil::factory(10)->create();
        \App\Models\User::factory(1)->create(
            [
                'email' => 'xandyx2014@gmail.com'
            ]
        );
        \App\Models\Especie::factory(5)->create();
        \App\Models\Raza::factory(5)
            ->create();
        \App\Models\Etiqueta::factory(15)->create();
        \App\Models\TipoDenuncia::factory(15)->create();
        \App\Models\TipoPublicacion::factory(15)->create();
        \App\Models\PublicacionInformativa::factory(15)
            ->hasImagens(1)
            ->hasDenuncias(5)->create();
        \App\Models\Mascota::factory(15)
            ->hasImagens(3)
            ->hasEtiquetas(3)
            ->hasSeguimientos(5)
            ->create();
        \App\Models\PublicacionAdopcion::factory(10)
            ->hasDenuncias(4)
            ->hasSolicitudAdopcions(3)
            ->create();
    }
}
