<?php

namespace App\Livewire\Forms\Finance;

use App\Models\PgtoTipo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PgtoTipoForm extends Form
{
    public ?PgtoTipo $mov_grupo;

    // Regras de validação.
    #[Validate([
        'nome' => ['required', 'string', 'min:3', 'max:30'],
        'notas' => ['nullable', 'string', 'max:70'],
    ])]

    // Campos da tabela.
    public $nome;
    public $notas;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(PgtoTipo $registro)
    {
        $this->mov_grupo = $registro;
        $this->nome = $registro->nome;
        $this->notas = $registro->notas;
    }

    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        PgtoTipo::create([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->mov_grupo->update([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }
}
