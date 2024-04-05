<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Form
{
    public ?Permission $permission;

    // Regras de validação.
    #[Validate([
        'name' => ['required', 'string', 'min:3', 'max:50'],
        'model' => ['nullable', 'string', 'max:70'],
        'description' => ['nullable', 'string', 'max:100'],
    ])]

    // Campos da tabela.
    public $name;
    public $model;
    public $description;

    // Método p/ popular classe a partir do BD.
    public function setRegistro(Permission $registro)
    {
        $this->permission = $registro;
        $this->name = $registro->name;
        $this->model = $registro->model;
        $this->description = $registro->description;
    }

    // Método p/ persistir no BD.
    public function store()
    {
        $this->validate();
        Permission::create([
            'name' => $this->name,
            'model' => $this->model,
            'description' => $this->description,
            'guard_name' => 'web',
        ]);
        $this->reset();
    }

    // Método p/ atualizar no BD.
    public function update()
    {
        $this->validate();
        $this->permission->update([
            'name' => $this->name,
            'model' => $this->model,
            'description' => $this->description,
        ]);
        $this->reset();
    }
}
