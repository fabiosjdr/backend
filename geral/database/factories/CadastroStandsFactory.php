<?php

namespace Database\Factories;

use App\Models\CadastroStands;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CadastroStandsFactory extends Factory
{

    protected $model = CadastroStands::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        static $pag = 1;

        return [
            "INT_PAG" => $pag++,
            "STR_NM"  => $this->faker->unique()->name(),
            "STR_NM_FANT" => $this->faker->unique()->name(),
            "INT_AREA" => $this->faker->numberBetween(1,11),
            "INT_EST"  => 17,
            "INT_MUN"  => $this->faker->numberBetween(2243,3095),
            "STR_FACE" => $this->faker->url(),
            "STR_INST" => $this->faker->url(),
            "STR_WHAT" => $this->faker->phoneNumber(),
            "STR_SITE" => $this->faker->url(),
            "STR_TEL"  => $this->faker->phoneNumber(),
            "STR_CEL"  => $this->faker->phoneNumber(),
            "STR_EMAIL" => $this->faker->unique()->safeEmail(),
            "DESC_TEXT" => $this->faker->text($maxNbChars = 50),
            "DESC_PROD" => $this->faker->text($maxNbChars = 50),
            "LG_CONF"  => 'N',
            "STR_COTR_INT" => null
        ];
    }
}
