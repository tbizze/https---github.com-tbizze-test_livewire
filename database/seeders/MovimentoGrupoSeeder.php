<?php

namespace Database\Seeders;

use App\Models\MovimentoGrupo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovimentoGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //LctoGrupo::factory(4)->create();

        $items = [
            [
                'nome' => 'N. Sra. Apda.',
                'notas' => 'To discuss politics'
            ],
            [
                'nome' => 'CDP',
                'notas' => 'To discuss news and world events'
            ],
            [
                'nome' => 'Matriz',
                'notas' => 'To discuss cooking and food'
            ],
            [
                'nome' => "CSMP",
                'notas' => 'To discuss politics'
            ]
        ];

        foreach ($items as $item) {
            MovimentoGrupo::create($item);
        }
    }
}
