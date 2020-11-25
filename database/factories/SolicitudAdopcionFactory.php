<?php

namespace Database\Factories;

use App\Models\PublicacionAdopcion;
use App\Models\SolicitudAdopcion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudAdopcionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SolicitudAdopcion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'motivo' => $this->faker->realText(),
            'descripcion' => $this->faker->realText(),
            'estado' => 0,
            'user_id' => User::factory(),
            'publicacion_adopcion_id' => PublicacionAdopcion::factory()
        ];
    }
}
