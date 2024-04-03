<?php

namespace App\Livewire\Forms\Finance;

use App\Models\MovimentoGrupo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MovimentoGrupoForm extends Form
{
    public ?MovimentoGrupo $mov_grupo;

    // Regras de validação.
    #[Validate([
        'nome' => ['required', 'string', 'min:3', 'max:30'],
        'notas' => ['nullable', 'string', 'max:70'],
    ])]

    // Campos da tabela.
    public $nome;
    public $notas;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(MovimentoGrupo $registro)
    {
        $this->mov_grupo = $registro;
        $this->nome = $registro->nome;
        $this->notas = $registro->notas;
    }

    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        MovimentoGrupo::create([
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
