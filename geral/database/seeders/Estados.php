<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Estados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ESTADO')->insert(
            [

                
                ['INT_EST' => '1', 'NM_EST' => 'Rondônia', 'STR_SIGLA' => 'RO'],
                ['INT_EST' => '2', 'NM_EST' => 'Acre', 'STR_SIGLA' => 'AC'],
                ['INT_EST' => '3', 'NM_EST' => 'Amazonas', 'STR_SIGLA' => 'AM'],
                ['INT_EST' => '4', 'NM_EST' => 'Roraima', 'STR_SIGLA' => 'RR'],
                ['INT_EST' => '5', 'NM_EST' => 'Pará', 'STR_SIGLA' => 'PA'],
                ['INT_EST' => '6', 'NM_EST' => 'Amapá', 'STR_SIGLA' => 'AP'],
                ['INT_EST' => '7', 'NM_EST' => 'Tocantins', 'STR_SIGLA' => 'TO'],
                ['INT_EST' => '8', 'NM_EST' => 'Maranhão', 'STR_SIGLA' => 'MA'],
                ['INT_EST' => '9', 'NM_EST' => 'Piauí', 'STR_SIGLA' => 'PI'],
                ['INT_EST' => '10', 'NM_EST' => 'Ceará', 'STR_SIGLA' => 'CE'],
                ['INT_EST' => '11', 'NM_EST' => 'Rio Grande do Norte', 'STR_SIGLA' => 'RN'],
                ['INT_EST' => '12', 'NM_EST' => 'Paraíba', 'STR_SIGLA' => 'PB'],
                ['INT_EST' => '13', 'NM_EST' => 'Pernanbuco', 'STR_SIGLA' => 'PE'],
                ['INT_EST' => '14', 'NM_EST' => 'Alagoas', 'STR_SIGLA' => 'AL'],
                ['INT_EST' => '15', 'NM_EST' => 'Segipe', 'STR_SIGLA' => 'SE'],
                ['INT_EST' => '16', 'NM_EST' => 'Bahia', 'STR_SIGLA' => 'BA'],
                ['INT_EST' => '17', 'NM_EST' => 'Minas Gerais', 'STR_SIGLA' => 'MG'],
                ['INT_EST' => '18', 'NM_EST' => 'Espírito Santo', 'STR_SIGLA' => 'ES'],
                ['INT_EST' => '19', 'NM_EST' => 'Rio de Janeiro', 'STR_SIGLA' => 'RJ'],
                ['INT_EST' => '20', 'NM_EST' => 'São Paulo', 'STR_SIGLA' => 'SP'],
                ['INT_EST' => '21', 'NM_EST' => 'Paraná', 'STR_SIGLA' => 'PR'],
                ['INT_EST' => '22', 'NM_EST' => 'Santa Catarina', 'STR_SIGLA' => 'SC'],
                ['INT_EST' => '23', 'NM_EST' => 'Rio Grande do Sul', 'STR_SIGLA' => 'RS'],
                ['INT_EST' => '24', 'NM_EST' => 'Mato Grosso do Sul', 'STR_SIGLA' => 'MS'],
                ['INT_EST' => '25', 'NM_EST' => 'Mato Grosso', 'STR_SIGLA' => 'MT'],
                ['INT_EST' => '26', 'NM_EST' => 'Goiás', 'STR_SIGLA' => 'GO'],
                ['INT_EST' => '27', 'NM_EST' => 'Distritio Federal', 'STR_SIGLA' => 'DF']
            ]
        );
    }
}
