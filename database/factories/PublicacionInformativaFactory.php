<?php

namespace Database\Factories;

use App\Models\PublicacionInformativa;
use App\Models\TipoPublicacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublicacionInformativaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicacionInformativa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => Str::substr($this->faker->paragraph, 0, 200),
            'subtitulo' => Str::substr($this->faker->paragraph, 0, 150),
            'cuerpo' => $this->faker->realText(1000),
            'user_id' => User::factory(),
            'estado' => $this->faker->randomElement([0 , 1]),
            'tipo_publicacion_id' => TipoPublicacion::factory(),
        ];
    }
}
