<?php

namespace Database\Seeders;

use App\Models\CadastroProdutos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroProduto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CadastroProdutos::factory()->count(50)->create();
    }
}
