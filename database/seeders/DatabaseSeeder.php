<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FaturaEmissora;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Roda somente uma Seeder específica. 
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Roda um conjunto de Seeder.
        $this->call([

            /* PgtoFormaSeeder::class,
            StatusSeeder::class, */

            // Módulo Movimentos.
            //MovimentoGrupoSeeder::class,
            //MovimentoSeeder::class,
            
            // Módulo fatura.
            //FaturaGrupoSeeder::class,
            //FaturaEmissoraSeeder::class,
            FaturaSeeder::class,
            //FaturaItemSeeder::class,

        ]);

        
    }
}
