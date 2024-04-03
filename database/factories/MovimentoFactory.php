<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movimento>
 */
class MovimentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = $this->faker->randomElement(['C', 'D']);
        if ($tipo == 'D'){
            $valor = $this->faker->randomFloat(2,10,7000)*-1;
        }elseif ($tipo == 'C'){
            $valor = $this->faker->randomFloat(2,10,7000);
        }
        
        return [
            'dt_movimento' => $this->faker->dateTimeBetween('-2 year','-1 week'),
            'tipo' => $tipo,
            'valor'=> $valor,
            'historico'=> $this->faker->sentence(3),
            'notas'=> $this->faker->sentence,
            
            'movimento_grupo_id' => $this->faker->numberBetween(1, 4),
            'pgto_tipo_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}


