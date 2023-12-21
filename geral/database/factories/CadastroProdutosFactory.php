<?php

namespace Database\Factories;

use App\Models\CadastroProdutos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroProdutos>
 */
class CadastroProdutosFactory extends Factory
{   

    protected $model = CadastroProdutos::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "DESC_PROD" => $this->faker->text($maxNbChars = 20),
            "DESC_PROD_ENG" => $this->faker->text($maxNbChars = 20),
        ];
    }
}
