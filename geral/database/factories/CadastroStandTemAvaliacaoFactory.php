<?php

namespace Database\Factories;

use App\Models\CadastroStandTemAvaliacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroStandTemAvaliacao>
 */
class CadastroStandTemAvaliacaoFactory extends Factory
{

    protected $model = CadastroStandTemAvaliacao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "INT_STAND" => $this->faker->numberBetween(10,50),
            "INT_USU"   => $this->faker->numberBetween(11,50),
            "DESC_AVAL" => $this->faker->text($maxNbChars = 50),
            "VR_AVAL"   => $this->faker->numberBetween(1,5),
        ];
    }
}
