<?php

namespace App\Livewire\Forms\Event;

use App\Models\EventoLocal;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventoLocalForm extends Form
{
    public ?EventoLocal $fat_grupo;

    // Regras de validação.
    #[Validate([
        'nome' => ['required', 'string', 'min:3', 'max:30'],
        'notas' => ['nullable', 'string', 'max:70'],
    ])]

    // Campos da tabela.
    public $nome;
    public $notas;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(EventoLocal $registro)
    {
        $this->fat_grupo = $registro;
        $this->nome = $registro->nome;
        $this->notas = $registro->notas;
    }

    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        EventoLocal::create([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->fat_grupo->update([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }
}
