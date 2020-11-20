<?php

namespace Database\Factories;

use App\Models\Denuncia;
use App\Models\TipoDenuncia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DenunciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Denuncia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => Str::substr($this->faker->paragraph, 0 , 200),
            'tipo_denuncia_id' => TipoDenuncia::factory()
        ];
    }
}
