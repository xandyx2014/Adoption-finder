<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\Seguimiento;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeguimientoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Seguimiento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => $this->faker->text,
            'calidad' => $this->faker->randomElement(['Buena', 'Mala', 'Normal', 'Decepcionante', 'Regular', 'Medio', 'Satisfactorio']),
            'puntuacion' => $this->faker->randomNumber(2),
            'mascota_id' => Mascota::factory()
        ];
    }
}
