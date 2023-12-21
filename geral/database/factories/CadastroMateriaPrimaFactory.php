<?php

namespace Database\Factories;

use App\Models\CadastroMateriaPrima;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CadastroMateriaPrimaFactory extends Factory
{

    protected $model = CadastroMateriaPrima::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "DESC_MAT" => $this->faker->text($maxNbChars = 15),
            "DESC_MAT_ENG" => $this->faker->text($maxNbChars = 15),
        ];
    }
}
