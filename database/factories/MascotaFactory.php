<?php

namespace Database\Factories;

use App\Models\Especie;
use App\Models\Mascota;
use App\Models\Raza;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MascotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mascota::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'color' => $this->faker->randomElement(['Cafe', 'Negro', 'Blanco', 'Cafe']),
            'nombre' => Str::substr($this->faker->firstName, 0 ,20),
            'descripcion' => Str::substr($this->faker->realText(), 0 ,20),
            'tamagno' => $this->faker->randomElement(['Pequeño', 'Mediano', 'Grande']),
            'salud' => $this->faker->randomElement(['Mal', 'Buena', 'Malita', 'Excelente']),
            'about' => Str::substr($this->faker->realText(), 0 ,100),
            'adoptado' => 0,
            'raza_id' => Raza::factory(),
            'user_id' => User::factory(),
            'especie_id' => Especie::factory()
        ];
    }
}
