<?php

namespace Database\Seeders;

use App\Models\PgtoForma;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PgtoFormaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //FatGrupo::factory(4)->create();

        $items = [
            [
                'nome' => 'Dinheiro',
                'notas' => 'To discuss politics'
            ],
            [
                'nome' => 'CEF Tiago',
                'notas' => 'To discuss news and world events'
            ],
            [
                'nome' => 'Nubank Tiago',
                'notas' => 'To discuss cooking and food'
            ],
            [
                'nome' => "Bradesco Eli",
                'notas' => 'To discuss politics'
            ],
            [
                'nome' => "Mercantil Eli",
                'notas' => 'To discuss politics'
            ]
        ];
    
        foreach ($items as $item) {
            PgtoForma::create($item);
        }
    }
}
