<?php

namespace Database\Seeders;

use App\Models\CadastroStandTemCurtida;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStandTemCurtida extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStandTemCurtida::factory()->count(100)->create();
    }
}
