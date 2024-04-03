<?php

namespace App\Livewire\Finance;

use App\Livewire\Forms\Finance\PgtoTipoForm;
use App\Models\PgtoTipo;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class PgtoTipoIndex extends Component
{
    use Toast;
    use WithPagination;

    public array $sortBy = ['column' => 'nome', 'direction' => 'asc'];
    public string $search = '';

    public bool $modalRegistro = false;
    public bool $modalConfirmDelete = false;
    public bool $registroEditMode = false;

    public PgtoTipoForm $form;
    public $registro_id = '';
    public $page_title = 'Tipos de Pgto';

    // Método p/ habilitar modal Edit/Create.
    public function showModalRegistro()
    {
        $this->form->reset();
        $this->modalRegistro = true;
    }

    // Método p/ carregar inputs do form.
    public function edit($id)
    {
        $registro = PgtoTipo::find($id);
        $this->form->setRegistro($registro);
        $this->registroEditMode = true;
        $this->modalRegistro = true;
    }

    // Método p/ salvar: STORE ou UPDATE
    public function save()
    {
        if ($this->registroEditMode) {
            $this->form->update();
            $this->registroEditMode = false;
            $this->success('Registro salvo com sucesso!');
        } else {
            $this->form->store();
            $this->success('Registro incluído com sucesso!');
        }
        $this->modalRegistro = false;
    }

    // Método p/ confirmar delete.
    public function confirmDelete($id)
    {
        $this->registro_id = $id;
        $this->modalConfirmDelete = true;
    }

    // Método para deletar.
    public function delete($id)
    {
        PgtoTipo::find($id)->delete();
        $this->modalConfirmDelete = false;
        $this->success('Registro excluído com sucesso!');
    }

    /* Dados da tabela */
    public function pgto_tipos()
    {
        return PgtoTipo::query()
            ->when($this->search, function ($query, $val) {
                $query->where('nome', 'like', '%' . $val . '%');
                $query->orWhere('notas', 'like', '%' . $val . '%');
                return $query;
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(4);
    }

    /* Cabeçalho da tabela */
    public function headers()
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'nome', 'label' => 'Nome'],
            ['key' => 'notas', 'label' => 'Notas', 'sortable' => false],
        ];
    }

    /* Renderiza componente */
    #[Title('Tipos de Pgto')]
    public function render()
    {
        return view('livewire.finance.pgto-tipo-index', [
            'headers' => $this->headers(),
            'pgto_tipos' => $this->pgto_tipos(),
        ]);
    }
}
