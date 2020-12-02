<?php

namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Etiqueta;
use App\Models\Imagen;
use App\Models\Mascota;
use App\Models\Perfil;
use App\Models\Raza;
use App\Models\Rol;
use App\Models\Seguimiento;
use App\Models\TipoDenuncia;
use App\Models\TipoPublicacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*\App\Models\Perfil::factory(10)
            ->create();
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
        \App\Models\Permiso::factory(5)
            ->hasRol(4)
            ->create();*/
        Rol::factory()->count(4)
            ->state( new Sequence(
                ['id' => 1, 'nombre' => 'admin' ],
                ['id' => 2, 'nombre' => 'Autor' ],
                ['id' => 3, 'nombre' => 'Editor' ],
                ['id' => 4, 'nombre' => 'usuario' ],
            ))
            ->create();
        Etiqueta::factory()
            ->count(10)
            ->state( new Sequence(
                [ 'nombre' => 'divertido'],
                [ 'nombre' => 'genial'],
                [ 'nombre' => 'fantastico'],
                [ 'nombre' => 'timido'],
                [ 'nombre' => 'silencioso'],
                [ 'nombre' => 'agresivo'],
                [ 'nombre' => 'amigable'],
                [ 'nombre' => 'sociable'],
                [ 'nombre' => 'cariñoso'],
                [ 'nombre' => 'jugueton'],
            ))
            ->create();
        Raza::factory()
            ->count(15)
            ->state( new Sequence(
                [ 'nombre' => 'Akita', 'descripcion' => 'raza de perro amarillenta y con una cola torcida'],
                [ 'nombre' => 'American Bully', 'descripcion' => 'raza de perro pequeña pero con grandes musculos'],
                [ 'nombre' => 'American Pitbull', 'descripcion' => 'raza de perro musculosa y de tamaño mediano que puede ser considerada peligrosa'],
                [ 'nombre' => 'Beagle', 'descripcion' => 'raza de perro de tamaño pequeña de orejas largas y muy juguetones'],
                [ 'nombre' => 'Bull terrier', 'descripcion' => 'raza de perro de tamaño pequeña '],
                [ 'nombre' => 'Bulldog Frances', 'descripcion' => 'raza de perro pequeña musculosa y de orejas paradas'],
                [ 'nombre' => 'Bulldog Ingles', 'descripcion' => 'raza de perro pequeña muy parecido a bulldog frances solo que tiene las orejas caidas'],
                [ 'nombre' => 'San Bernando', 'descripcion' => 'raza de perro muy grande y de gran cantidad de pelo muy grandes y juguetones'],
                [ 'nombre' => 'Pastor aleman', 'descripcion' => 'raza de perro mediana muy juguetones y cariñosos'],
                [ 'nombre' => 'pincher', 'descripcion' => 'raza de perro pequeña muy ladradores y muy inquietos'],
                [ 'nombre' => 'Siamés', 'descripcion' => 'Los siameses son una raza de gatos muy comunes y una de las más conocidas para los amantes de los gatos. A estos gatos les encanta maullar, lo que además les caracteriza, ya que tienen un maullido muy peculiar.'],
                [ 'nombre' => 'Persa', 'descripcion' => 'El gato persa es otra de las razas más conocidas de gatos y siempre ha estado ligado a la nobleza y la elegancia.Es un gato muy bonito, pero que a la vez se gana muchos adeptos por su carácter noble, amable y cariñoso.'],
                [ 'nombre' => 'Siberiano', 'descripcion' => 'Espectacular a la vista, este gato es procedente de la zona oriental de Rusia, en concreto de Siberia y se dice que es el resultado del cruce entre el gato europeo y el gato salvaje de los bosques siberianos.'],
                [ 'nombre' => 'Gato Manés', 'descripcion' => 'De tamaño mediano y pelaje semilargo, este gato es muy especial, ya que es el único gato que ha sufrido una mutación natural en su columna vertebral, provocando que no tengan cola, sino simplemente un pequeño muñón'],
                [ 'nombre' => 'Gato Birmano o Burmés', 'descripcion' => 'Este gato proviene de Tailandia y también es un gato perruno, del que se le caracteriza su carácter amable, extrovertido y flexible. Pero sobre todo, es un gato que te viene a saludar a la puerta, tal como hacen los perros.'],
            ))
            ->create();
        Especie::factory()
            ->count(5)
            ->state(new Sequence(
                [ 'nombre' => 'Mamíferos', 'descripcion' => 'Los mamíferos (Mammalia) son una clase de animales vertebrados amniotas homeotermos (de «sangre caliente») que poseen glándulas mamarias productoras de leche con las que alimentan a las crías. '],
                [ 'nombre' => 'Aves',  'descripcion' => 'Las aves son animales vertebrados, de sangre caliente, que caminan, saltan o se mantienen solo sobre las extremidades posteriores'],
                [ 'nombre' => 'Reptiles',  'descripcion' => 'Los reptiles (Reptilia) son una clase de animales vertebrados amniotas provistos de escamas epidérmicas de queratina. Fueron muy abundantes en el Mesozoico,'],
                [ 'nombre' => 'Ranas y sapos',  'descripcion' => 'Los anfibios que significa «ambas vidas» o «en ambos medios») son una clase de animales vertebrados anamniotas (sin amnios, como los peces), tetrápodos, ectotérmicos'],
                [ 'nombre' => 'Arañas y alacranes',  'descripcion' => ' El grupo incluye animales invertebrados dotados de un esqueleto externo y apéndices articulados; entre otros, se incluyen en este grupo a los insectos, arácnidos, crustáceos y miriápodos.']
            ))
            ->create();
        TipoDenuncia::factory()
            ->count(4)
            ->state(
                new Sequence(
                    [ 'tipo' => 'Contenido no apropiado', 'descripcion' => 'Contenido que no es apropiado para la plataforma'],
                    [ 'tipo' => 'Sexual', 'descripcion' => 'Contenido es sexual y puede Herir la sensibilidad'],
                    [ 'tipo' => 'Violencia', 'descripcion' => 'Contenido es violento y puede Herir la sensibilidad'],
                    [ 'tipo' => 'Contenido tiene Odio', 'descripcion' => 'Contenido muestra odio y puede Herir la sensibilidad'],
                )
            )
            ->create();
        TipoPublicacion::factory()
            ->count(4)
            ->state( new Sequence(
                [ 'tipo' => 'Informativo'],
                [ 'tipo' => 'Tips para la salud'],
                [ 'tipo' => 'Informacion en general'],
                [ 'tipo' => 'Salud de la mascota']
            ))
            ->create();
        User::factory(1)
            ->hasPerfil()
            ->create(
            [
                'rol_id' => 1,
                'name' => 'Andy jesus macias gomez',
                'email' => 'xandyx2014@gmail.com'
            ]
        );
        User::factory()
            ->count(20)
            ->state( new Sequence(
                ['rol_id' => 2],
                ['rol_id' => 3],
                ['rol_id' => 4])
            )
            ->hasPerfil()
            ->create();
        Mascota::factory()
            ->count(20)
            ->state(function (array $attr, $item) {
                return ['raza_id' => rand(1, 15), 'especie_id' => rand(1,5)];
            })
            ->has(
                Seguimiento::factory()->count(3)
            )
            ->create();
        /*User::factory()
            ->count(10)
            ->has(
                Perfil::factory()->count(1)
            )
            ->create();*/


    }
}
