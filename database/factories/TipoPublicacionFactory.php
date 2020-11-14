<?php

namespace Database\Factories;

use App\Models\TipoPublicacion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoPublicacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoPublicacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => Str::random(10),
        ];
    }
}
