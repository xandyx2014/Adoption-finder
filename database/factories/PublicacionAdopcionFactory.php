<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\PublicacionAdopcion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublicacionAdopcionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicacionAdopcion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titulo' => Str::substr($this->faker->realText(), 0 ,20),
            'descripcion_corta' => $this->faker->realText(1000),
            'user_id' => User::factory(),
            'mascota_id' => Mascota::factory()
        ];
    }
}
