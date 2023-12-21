<?php

namespace Database\Factories;

use App\Models\CadastroStandTemGaleria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroStandTemGaleria>
 */
class CadastroStandTemGaleriaFactory extends Factory
{

    protected $model = CadastroStandTemGaleria::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "INT_STAND" => $this->faker->numberBetween(1,50),
            "STR_URL"   => $this->faker->url(),
        ];
    }
}
