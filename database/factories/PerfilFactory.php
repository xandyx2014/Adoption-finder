<?php

namespace Database\Factories;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'apellidos' => $this->faker->lastName,
            'apodo' => Str::substr( $this->faker->userName, 0 ,15 ) ,
            'telefono' => $this->faker->phoneNumber,
            'about' => $this->faker->realText(),
            'user_id' => User::factory()
        ];
    }
}
