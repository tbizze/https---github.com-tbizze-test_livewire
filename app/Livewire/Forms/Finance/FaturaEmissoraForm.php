<?php

namespace App\Livewire\Forms\Finance;

use App\Models\FaturaEmissora;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FaturaEmissoraForm extends Form
{
    public ?FaturaEmissora $fat_emissora;

    // Regras de validação.
    #[Validate([
        'nome' => ['required', 'string', 'min:3', 'max:30'],
        'notas' => ['nullable', 'string', 'max:70'],
    ])]

    // Campos da tabela.
    public $nome;
    public $notas;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(FaturaEmissora $registro)
    {
        $this->fat_emissora = $registro;
        $this->nome = $registro->nome;
        $this->notas = $registro->notas;
    }

    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        FaturaEmissora::create([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->fat_emissora->update([
            'nome' => $this->nome,
            'notas' => $this->notas,
        ]);
        $this->reset();
    }
}
