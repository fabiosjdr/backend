<?php

namespace Database\Seeders;

use App\Models\CadastroStands;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakeCadastroStand extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CadastroStands::factory()->count(50)->create();
    }
}
