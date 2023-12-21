<?php

namespace Database\Factories;

use App\Models\CadastroStandTemCurtida;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroStandTemCurtida>
 */
class CadastroStandTemCurtidaFactory extends Factory
{


    protected $model = CadastroStandTemCurtida::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "INT_STAND" => $this->faker->numberBetween(1,50),
            "INT_USU" => $this->faker->numberBetween(10,50),
        ];
    }
}
