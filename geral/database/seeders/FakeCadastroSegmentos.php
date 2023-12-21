<?php

namespace Database\Seeders;

use App\Models\CadastroSegmentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroSegmentos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroSegmentos::factory()->count(50)->create();
    }
}
