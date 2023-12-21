<?php

namespace Database\Factories;

use App\Models\CadastroSegmentos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CadastroSegmentosFactory extends Factory
{

    protected $model = CadastroSegmentos::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "DESC_SEG" => $this->faker->text($maxNbChars = 20),
            "DESC_SEG_ENG" => $this->faker->text($maxNbChars = 20),
        ];
    }
}
