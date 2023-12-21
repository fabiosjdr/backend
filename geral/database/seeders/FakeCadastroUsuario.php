<?php

namespace Database\Seeders;

use App\Models\CadastroUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroUsuario extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroUsuario::factory()->count(50)->create();

    }
}
