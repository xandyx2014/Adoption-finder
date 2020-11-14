<?php

namespace Database\Factories;

use App\Models\TipoDenuncia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TipoDenunciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoDenuncia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => Str::random(10),
            'descripcion' =>  Str::random(100)
        ];
    }
}
