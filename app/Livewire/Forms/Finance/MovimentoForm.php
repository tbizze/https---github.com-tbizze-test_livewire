<?php

namespace App\Livewire\Forms\Finance;

use App\Models\Movimento;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MovimentoForm extends Form
{
    public ?Movimento $movimento;

    // Regras de validação.
    #[Validate([
        'dt_movimento' => ['required', 'date'],
        'valor' => ['required', 'decimal:2'],
        'tipo' => ['required', 'string', 'size:1'],
        'historico' => ['nullable', 'string', 'min:3', 'max:50'],
        'movimento_grupo_id' => ['nullable', 'integer'],
        'pgto_tipo_id' => ['nullable', 'integer'],
        'notas' => ['nullable', 'string', 'max:70'],
    ])]

    // Campos da tabela.
    public $dt_movimento;
    public $valor;
    public $tipo;
    public $historico;
    public $movimento_grupo_id;
    public $pgto_tipo_id;
    public $notas;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(Movimento $registro)
    {
        $this->movimento = $registro;
        $this->dt_movimento = $registro->dt_movimento->format('Y-m-d');
        $this->valor = $registro->valor;
        $this->tipo = $registro->tipo;
        $this->historico = $registro->historico;
        $this->movimento_grupo_id = $registro->movimento_grupo_id;
        $this->pgto_tipo_id = $registro->pgto_tipo_id;
        $this->notas = $registro->notas;
    }
    
    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        Movimento::create([
            'dt_movimento' => $this->dt_movimento,
            'valor' => $this->valor,
            'tipo' => $this->tipo,
            'historico' => $this->historico,
            'movimento_grupo_id' => $this->movimento_grupo_id,
            'pgto_tipo_id' => $this->pgto_tipo_id,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->movimento->update([
            'dt_movimento' => $this->dt_movimento,
            'valor' => $this->valor,
            'tipo' => $this->tipo,
            'historico' => $this->historico,
            'movimento_grupo_id' => $this->movimento_grupo_id,
            'pgto_tipo_id' => $this->pgto_tipo_id,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }
}
