<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemProduto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemProduto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemProduto::factory()->count(200)->create();
    }
}
