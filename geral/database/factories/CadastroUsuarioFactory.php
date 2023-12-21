<?php

namespace Database\Factories;

use App\Models\CadastroUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CadastroUsuarioFactory extends Factory
{

    protected $model = CadastroUsuario::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "SHA1_SENHA" =>Hash::make("Password"),
            "STR_EMAIL" =>$this->faker->unique()->safeEmail(),
            "LG_SUPER" => "N",
            "LG_ATV"   => "S",
            "INT_EST"  => 17,
            "INT_MUN"  => $this->faker->numberBetween(2243,3095)
            
        ];
    }
}
