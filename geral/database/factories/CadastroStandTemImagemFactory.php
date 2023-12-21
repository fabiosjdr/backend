<?php

namespace Database\Factories;

use App\Models\CadastroStandTemImagem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CadastroStandTemImagem>
 */
class CadastroStandTemImagemFactory extends Factory
{

    protected $model = CadastroStandTemImagem::class;


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
            "STR_TP"    => 'P',
        ];
    }
}
