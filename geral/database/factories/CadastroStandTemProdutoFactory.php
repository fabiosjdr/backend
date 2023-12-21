<?php

namespace Database\Factories;

use App\Models\CadastroStandTemProduto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroStandTemProduto>
 */
class CadastroStandTemProdutoFactory extends Factory
{

    protected $model = CadastroStandTemProduto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "INT_STAND" => $this->faker->numberBetween(10,50),
            "INT_PROD"   => $this->faker->numberBetween(2,50),
        ];
    }
}
