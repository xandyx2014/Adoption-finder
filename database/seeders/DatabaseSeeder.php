<?php

namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Etiqueta;
use App\Models\Imagen;
use App\Models\Mascota;
use App\Models\Perfil;
use App\Models\Permiso;
use App\Models\PublicacionInformativa;
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
                ['id' => 4, 'nombre' => 'Usuario' ],
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
        User::factory(4)
            ->state(new Sequence(
                [
                    'rol_id' => 1,
                    'name' => 'Andy jesus macias gomez',
                    'email' => 'xandyx2014@gmail.com'
                ],
                [
                    'rol_id' => 4,
                    'name' => 'usuario',
                    'email' => 'usuario@usuario.com'
                ],
                [
                    'rol_id' => 3,
                    'name' => 'editor',
                    'email' => 'editor@editor.com'
                ],
                [
                    'rol_id' => 2,
                    'name' => 'autor',
                    'email' => 'autor@autor.com'
                ],
            ))
            ->hasPerfil()
            ->create();
        User::factory()
            ->count(5)
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
                return ['raza_id' => rand(1, 15), 'especie_id' => rand(1,5), 'user_id' => rand(2, 6)];
            })
            ->has(
                Seguimiento::factory()->count(3)
            )
            ->create();
        PublicacionInformativa::factory()
            ->count(10)
            ->state( function (array $attr, $item) {
                return [ 'user_id' => rand(2, 6), 'tipo_publicacion_id' => rand(1,4)];
            })
            ->has(
                Imagen::factory()->count(1)
            )
            ->create();
        // Gestionar mascota
        DB::table('permisos')->insert([
            // gestionar mascota
            ['id' => 1 ,'nombre' =>'registrar-mascota'],
            ['id' => 2 ,'nombre' =>'buscar-mascota'],
            ['id' => 3 ,'nombre' =>'editar-mascota'],
            ['id' => 4 ,'nombre' =>'estado-mascota'],
            ['id' => 5 ,'nombre' =>'eliminar-mascota'],
            ['id' => 6 ,'nombre' =>'consultar-mascota'],
            ['id' => 7 ,'nombre' =>'listar-mascota'],
            // Gestionar publicacion de adopcion
            ['id' => 8 ,'nombre' =>'registrar-publicacion-adopcion'],
            ['id' => 9 ,'nombre' =>'buscar-publicacion-adopcion'],
            ['id' => 10 ,'nombre' =>'editar-publicacion-adopcion'],
            ['id' => 11 ,'nombre' =>'estado-publicacion-adopcion'],
            ['id' => 12 ,'nombre' =>'eliminar-publicacion-adopcion'],
            ['id' => 13 ,'nombre' =>'consultar-publicacion-adopcion'],
            ['id' => 14 ,'nombre' =>'listar-publicacion-adopcion'],
            // Gestionar seguimiento mascota
            ['id' => 15 ,'nombre' =>'registrar-seguimiento-mascota'],
            ['id' => 16 ,'nombre' =>'buscar-seguimiento-mascota'],
            ['id' => 17 ,'nombre' =>'editar-seguimiento-mascota'],
            ['id' => 18 ,'nombre' =>'estado-seguimiento-mascota'],
            ['id' => 19 ,'nombre' =>'eliminar-seguimiento-mascota'],
            ['id' => 20 ,'nombre' =>'consultar-seguimiento-mascota'],
            ['id' => 21 ,'nombre' =>'listar-seguimiento-mascota'],
            // Aprobar rechazar solicitud de adopcion
            ['id' => 22 ,'nombre' =>'buscar-aprobar-rechazar-solicitud'],
            ['id' => 23 ,'nombre' =>'listar-aprobar-rechazar-solicitud'],
            ['id' => 24 ,'nombre' =>'aprobar-rechazar-solicitud'],
            // Administrar galeria de foto de mascota
            ['id' => 25 ,'nombre' =>'listar-galeria-mascota'],
            ['id' => 26 ,'nombre' =>'registrar-galeria-mascota'],
            ['id' => 27 ,'nombre' =>'eliminar-galeria-mascota'],
            // Gestionar solicitud de adopcion
            ['id' => 28 ,'nombre' =>'registrar-solicitud-adopcion'],
            ['id' => 29 ,'nombre' =>'buscar-solicitud-adopcion'],
            ['id' => 30 ,'nombre' =>'editar-solicitud-adopcion'],
            ['id' => 31 ,'nombre' =>'estado-solicitud-adopcion'],
            ['id' => 32 ,'nombre' =>'eliminar-solicitud-adopcion'],
            ['id' => 33 ,'nombre' =>'consultar-solicitud-adopcion'],
            ['id' => 34 ,'nombre' =>'listar-solicitud-adopcion'],
            // Gestionar tipo de publicacion
            ['id' => 35 ,'nombre' =>'registrar-tipo-publicacion'],
            ['id' => 36,'nombre' =>'buscar-tipo-publicacion'],
            ['id' => 37 ,'nombre' =>'editar-tipo-publicacion'],
            ['id' => 38 ,'nombre' =>'estado-tipo-publicacion'],
            ['id' => 39 ,'nombre' =>'eliminar-tipo-publicacion'],
            ['id' => 40 ,'nombre' =>'consultar-tipo-publicacion'],
            ['id' => 41,'nombre' =>'listar-tipo-publicacion'],
            // gestionar tipo de denuncia
            ['id' => 42 ,'nombre' =>'registrar-tipo-denuncia'],
            ['id' => 43,'nombre' =>'buscar-tipo-denuncia'],
            ['id' => 44 ,'nombre' =>'editar-tipo-denuncia'],
            ['id' => 45 ,'nombre' =>'estado-tipo-denuncia'],
            ['id' => 46 ,'nombre' =>'eliminar-tipo-denuncia'],
            ['id' => 47 ,'nombre' =>'consultar-tipo-denuncia'],
            ['id' => 48,'nombre' =>'listar-tipo-denuncia'],
            // Aprobar o rechazar solicitud de publicacion informativa
            ['id' => 49,'nombre' =>'aprobar-solicitud-publicacion'],
            ['id' => 50,'nombre' =>'rechazar-solicitud-publicacion'],
            ['id' => 51,'nombre' =>'listar-solicitud-publicacion'],
            // administrar galeria de foto de publicacion
            ['id' => 52,'nombre' =>'listar-galeria-publicacion-informativa'],
            ['id' => 53,'nombre' =>'editar-galeria-publicacion-informativa'],
            ['id' => 54,'nombre' =>'eliminar-galeria-publicacion-informativa'],
            // Gestionar publicacion informativas
            ['id' => 55,'nombre' =>'registrar-publicacion-informativa'],
            ['id' => 56,'nombre' =>'buscar-publicacion-informativa'],
            ['id' => 57,'nombre' =>'editar-publicacion-informativa'],
            ['id' => 58,'nombre' =>'estado-publicacion-informativa'],
            ['id' => 59,'nombre' =>'eliminar-publicacion-informativa'],
            ['id' => 60,'nombre' =>'consultar-publicacion-informativa'],
            ['id' => 61,'nombre' =>'listar-publicacion-informativa'],
            // Gestionar denuncia
            ['id' => 62 ,'nombre' =>'registrar-denuncia'],
            ['id' => 63 ,'nombre' =>'buscar-denuncia'],
            ['id' => 64 ,'nombre' =>'editar-denuncia'],
            ['id' => 65 ,'nombre' =>'estado-denuncia'],
            ['id' => 66 ,'nombre' =>'eliminar-denuncia'],
            ['id' => 67 ,'nombre' =>'consultar-denuncia'],
            ['id' => 68 ,'nombre' =>'listar-denuncia'],
            // Gestionar especie
            ['id' => 69 ,'nombre' =>'registrar-especie'],
            ['id' => 70 ,'nombre' =>'buscar-especie'],
            ['id' => 71 ,'nombre' =>'editar-especie'],
            ['id' => 72 ,'nombre' =>'estado-especie'],
            ['id' => 73 ,'nombre' =>'eliminar-especie'],
            ['id' => 74 ,'nombre' =>'consultar-especie'],
            ['id' => 75 ,'nombre' =>'listar-especie'],
            // Gestionar raza
            ['id' => 76 ,'nombre' =>'registrar-raza'],
            ['id' => 77 ,'nombre' =>'buscar-raza'],
            ['id' => 78 ,'nombre' =>'editar-raza'],
            ['id' => 79 ,'nombre' =>'estado-raza'],
            ['id' => 80 ,'nombre' =>'eliminar-raza'],
            ['id' => 81 ,'nombre' =>'consultar-raza'],
            ['id' => 82 ,'nombre' =>'listar-raza'],
            // Gestionar etiqueta
            ['id' => 83 ,'nombre' =>'registrar-etiqueta'],
            ['id' => 84 ,'nombre' =>'buscar-etiqueta'],
            ['id' => 85 ,'nombre' =>'editar-etiqueta'],
            ['id' => 86 ,'nombre' =>'estado-etiqueta'],
            ['id' => 87 ,'nombre' =>'eliminar-etiqueta'],
            ['id' => 88 ,'nombre' =>'consultar-etiqueta'],
            ['id' => 89 ,'nombre' =>'listar-etiqueta'],
            // Gestionar usuario
            ['id' => 90 ,'nombre' =>'registrar-usuario'],
            ['id' => 91 ,'nombre' =>'buscar-usuario'],
            ['id' => 92 ,'nombre' =>'editar-usuario'],
            ['id' => 93 ,'nombre' =>'estado-usuario'],
            ['id' => 94 ,'nombre' =>'eliminar-usuario'],
            ['id' => 95 ,'nombre' =>'consultar-usuario'],
            ['id' => 96 ,'nombre' =>'listar-usuario'],
            // Gestionar roles
            ['id' => 97 ,'nombre' =>'registrar-rol'],
            ['id' => 98 ,'nombre' =>'buscar-rol'],
            ['id' => 99 ,'nombre' =>'editar-rol'],
            ['id' => 100 ,'nombre' =>'estado-rol'],
            ['id' => 101 ,'nombre' =>'eliminar-rol'],
            ['id' => 102 ,'nombre' =>'consultar-rol'],
            ['id' => 103 ,'nombre' =>'listar-rol'],
            // Administra permiso
            ['id' => 104 ,'nombre' => 'asignar-permiso'],
            ['id' => 105 ,'nombre' => 'buscar-permiso'],
            ['id' => 106 ,'nombre' => 'listar-permiso'],
            // Administrar permiso
            ['id' => 107 ,'nombre' => 'listar-bitacora'],
            ['id' => 108 ,'nombre' => 'buscar-bitacora'],
            ['id' => 109 ,'nombre' => 'consultar-bitacora'],
            // Generar reportes
            ['id' => 110 ,'nombre' => 'generar-reporte-mascota'],
            ['id' => 111 ,'nombre' => 'generar-reporte-seguimiento'],
        ]);
        DB::table('permiso_rol')->insert([
            // gestionar mascota
            ['id' => 1, 'rol_id' => 4 , 'permiso_id' => 1],
            ['id' => 2, 'rol_id' => 4 , 'permiso_id' => 2],
            ['id' => 3, 'rol_id' => 4 , 'permiso_id' => 3],
            ['id' => 4, 'rol_id' => 4 , 'permiso_id' => 4],
            ['id' => 5, 'rol_id' => 4 , 'permiso_id' => 5],
            ['id' => 6, 'rol_id' => 4 , 'permiso_id' => 6],
            ['id' => 7, 'rol_id' => 4 , 'permiso_id' => 7],
            // gestionar publicacion de adopcion
            ['id' => 8, 'rol_id' => 4 , 'permiso_id' => 8],
            ['id' => 9, 'rol_id' => 4 , 'permiso_id' => 9],
            ['id' => 10, 'rol_id' => 4 , 'permiso_id' => 10],
            ['id' => 11, 'rol_id' => 4 , 'permiso_id' => 11],
            ['id' => 12, 'rol_id' => 4 , 'permiso_id' => 12],
            ['id' => 13, 'rol_id' => 4 , 'permiso_id' => 13],
            ['id' => 14, 'rol_id' => 4 , 'permiso_id' => 14],
            // gestionar seguimineto de mascota adoptada
            ['id' => 15, 'rol_id' => 4 , 'permiso_id' => 15],
            ['id' => 16, 'rol_id' => 4 , 'permiso_id' => 16],
            ['id' => 17, 'rol_id' => 4 , 'permiso_id' => 17],
            ['id' => 18, 'rol_id' => 4 , 'permiso_id' => 18],
            ['id' => 19, 'rol_id' => 4 , 'permiso_id' => 19],
            ['id' => 20, 'rol_id' => 4 , 'permiso_id' => 20],
            ['id' => 21, 'rol_id' => 4 , 'permiso_id' => 21],
            // Aprobar rechazar solicitud de adopcion
            ['id' => 22, 'rol_id' => 4 , 'permiso_id' => 22],
            ['id' => 23, 'rol_id' => 4 , 'permiso_id' => 23],
            ['id' => 24, 'rol_id' => 4 , 'permiso_id' => 24],
            // Administrar galeria de foto de mascota
            ['id' => 25, 'rol_id' => 4 , 'permiso_id' => 25],
            ['id' => 26, 'rol_id' => 4 , 'permiso_id' => 26],
            ['id' => 27, 'rol_id' => 4 , 'permiso_id' => 27],
            // Gestionar solicitud de adopcion
            ['id' => 28, 'rol_id' => 4 , 'permiso_id' => 28],
            ['id' => 29, 'rol_id' => 4 , 'permiso_id' => 29],
            ['id' => 30, 'rol_id' => 4 , 'permiso_id' => 30],
            ['id' => 31, 'rol_id' => 4 , 'permiso_id' => 31],
            ['id' => 32, 'rol_id' => 4 , 'permiso_id' => 32],
            ['id' => 33, 'rol_id' => 4 , 'permiso_id' => 33],
            ['id' => 34, 'rol_id' => 4 , 'permiso_id' => 34],
            // Gestionar tipo de publicacion
            ['id' => 35, 'rol_id' => 3 , 'permiso_id' => 35],
            ['id' => 36, 'rol_id' => 3 , 'permiso_id' => 36],
            ['id' => 37, 'rol_id' => 3 , 'permiso_id' => 37],
            ['id' => 38, 'rol_id' => 3 , 'permiso_id' => 38],
            ['id' => 39, 'rol_id' => 3 , 'permiso_id' => 39],
            ['id' => 40, 'rol_id' => 3 , 'permiso_id' => 40],
            ['id' => 41, 'rol_id' => 3 , 'permiso_id' => 41],
            // Gestionar tipo de denuncia => solo admin
            // Solo admin
            // Aprobar o rechazar solicitud de publicacion infromativa
            ['id' => 42, 'rol_id' => 3 , 'permiso_id' => 49],
            ['id' => 43, 'rol_id' => 3 , 'permiso_id' => 50],
            ['id' => 44, 'rol_id' => 3 , 'permiso_id' => 51],
            // Administra galeria de foto de publicaicon
            ['id' => 45, 'rol_id' => 3 , 'permiso_id' => 52],
            ['id' => 46, 'rol_id' => 3 , 'permiso_id' => 53],
            ['id' => 47, 'rol_id' => 3 , 'permiso_id' => 54],
            // Gestionar publicaciones informativas => editor 3 y autor 2
                // editor
                ['id' => 48, 'rol_id' => 3 , 'permiso_id' => 55],
                ['id' => 49, 'rol_id' => 3 , 'permiso_id' => 56],
                ['id' => 50, 'rol_id' => 3 , 'permiso_id' => 57],
                ['id' => 51, 'rol_id' => 3 , 'permiso_id' => 58],
                ['id' => 52, 'rol_id' => 3 , 'permiso_id' => 59],
                ['id' => 53, 'rol_id' => 3 , 'permiso_id' => 60],
                ['id' => 54, 'rol_id' => 3 , 'permiso_id' => 61],
                // autor
                ['id' => 55, 'rol_id' => 2 , 'permiso_id' => 55],
                ['id' => 56, 'rol_id' => 2 , 'permiso_id' => 56],
                ['id' => 57, 'rol_id' => 2 , 'permiso_id' => 57],
                ['id' => 58, 'rol_id' => 2 , 'permiso_id' => 58],
                ['id' => 59, 'rol_id' => 2 , 'permiso_id' => 59],
                ['id' => 60, 'rol_id' => 2 , 'permiso_id' => 60],
                ['id' => 61, 'rol_id' => 2 , 'permiso_id' => 61],
            // Gestionar denuncia
            ['id' => 62, 'rol_id' => 4 , 'permiso_id' => 62],
            ['id' => 63, 'rol_id' => 3 , 'permiso_id' => 63],
            ['id' => 64, 'rol_id' => 3 , 'permiso_id' => 64],
            ['id' => 65, 'rol_id' => 3 , 'permiso_id' => 65],
            ['id' => 66, 'rol_id' => 3 , 'permiso_id' => 66],
            ['id' => 67, 'rol_id' => 3 , 'permiso_id' => 67],
            ['id' => 68, 'rol_id' => 3 , 'permiso_id' => 68],
            // Generar reporte
            ['id' => 69, 'rol_id' => 4 , 'permiso_id' => 110],
            ['id' => 70, 'rol_id' => 4 , 'permiso_id' => 111],
        ]);
    }
}
