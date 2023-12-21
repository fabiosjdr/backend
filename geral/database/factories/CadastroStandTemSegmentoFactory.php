<?php

namespace Database\Factories;

use App\Models\CadastroStandTemSegmento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CadastroStandTemSegmentoFactory extends Factory
{

    protected $model = CadastroStandTemSegmento::class; 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "INT_STAND" => $this->faker->numberBetween(10,50),
            "INT_SEG"   => $this->faker->numberBetween(2,50),
        ];
    }
}
