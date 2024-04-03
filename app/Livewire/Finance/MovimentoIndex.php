<?php

namespace App\Livewire\Finance;

use App\Livewire\Forms\Finance\MovimentoForm;
use App\Models\Movimento;
use App\Models\MovimentoGrupo;
use App\Models\PgtoTipo;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class MovimentoIndex extends Component
{
    use Toast;
    use WithPagination;

    public array $sortBy = ['column' => 'dt_movimento', 'direction' => 'asc'];
    public string $search = '';

    public bool $modalRegistro = false;
    public bool $modalConfirmDelete = false;
    public bool $showDrawer = false;
    public bool $registroEditMode = false;

    public MovimentoForm $form;
    public $registro_id = '';
    public $qdeFilter = 0;

    /*  */
    public $page_title = 'Movimentos';
    public $date_config = ['altFormat' => 'd/m/Y'];
    /* Campos de filtros */
    public $date_init = '';
    public $date_end = '';
    public $fil_grupo = '';
    public $fil_pgto_tipo = '';
    public $fil_tipo = '';

    // Método p/ habilitar modal Edit/Create.
    public function showModalRegistro()
    {
        $this->form->reset();
        $this->modalRegistro = true;
    }

    // Método p/ carregar inputs do form.
    // Mas não carrega o modelo, para que ao salvar faça STORE()
    // Por isso registroEditMode = false
    public function copyRecord($id)
    {
        $registro = Movimento::find($id);
        $this->form->setRegistro($registro);
        $this->registroEditMode = false;
        $this->modalRegistro = true;
    }

    // Método p/ carregar inputs do form.
    public function edit($id)
    {
        $registro = Movimento::find($id);
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
        Movimento::find($id)->delete();
        $this->modalConfirmDelete = false;
        $this->success('Registro excluído com sucesso!');
    }

    public function filtrar()
    {
        $this->qdeFilter = 0;
        if ($this->fil_grupo) {
            $this->qdeFilter++;
        }
        if ($this->fil_pgto_tipo) {
            $this->qdeFilter++;
        }
        if ($this->fil_tipo) {
            $this->qdeFilter++;
        }
        if ($this->date_init) {
            $this->qdeFilter++;
        }
        if ($this->search) {
            $this->qdeFilter++;
        }

        $this->movimentos();
        $this->showDrawer = false;
    }

    public function limpaFiltros()
    {
        $this->search = '';
        $this->fil_grupo = '';
        $this->fil_pgto_tipo = '';
        $this->fil_tipo = '';
        $this->date_init = '';
        $this->date_end = '';
        $this->showDrawer = false;
        $this->qdeFilter = 0;
    }

    /* Dados da tabela */
    public function movimentos()
    {
        return Movimento::query()
            ->withAggregate('toMovimentoGrupo', 'nome')
            ->withAggregate('toPgtoTipo', 'nome')
            ->orderBy(...array_values($this->sortBy))
            ->when($this->search, function ($query, $val) {
                $query->where('historico', 'like', '%' . $val . '%');
                $query->orWhere('notas', 'like', '%' . $val . '%');
                return $query;
            })
            ->when($this->fil_pgto_tipo, function ($query, $val) {
                $query->where('pgto_tipo_id', $val);
                return $query;
            })
            ->when($this->fil_grupo, function ($query, $val) {
                $query->where('movimento_grupo_id', $val);
                return $query;
            })
            ->when($this->fil_tipo, function ($query, $val) {
                if ($val == 1) {
                    $query->where('tipo', 'C');
                } elseif ($val == 2) {
                    $query->where('tipo', 'D');
                };
                return $query;
            })
            ->when($this->date_init, function ($query, $val) {
                $query->whereBetween('dt_movimento', [$this->date_init, $this->date_end]);
                return $query;
            })
            ->paginate(10);
    }

    /* Cabeçalho da tabela */
    public function headers()
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'dt_movimento', 'label' => 'Dt. Mov.'],
            ['key' => 'valor', 'label' => 'Valor'],
            ['key' => 'tipo', 'label' => 'Tipo'],
            ['key' => 'historico', 'label' => 'Histórico', 'sortable' => false],
            ['key' => 'to_movimento_grupo_nome', 'label' => 'Grupo', 'sortBy' => 'to_movimento_grupo_nome'],
            ['key' => 'to_pgto_tipo_nome', 'label' => 'Tipo Pgto.', 'sortBy' => 'to_pgto_tipo_nome'],
            ['key' => 'notas', 'label' => 'Notas', 'sortable' => false],
        ];
    }

    
    /* Renderiza componente */
    #[Title('Movimento')]
    public function render()
    {
        return view('livewire.finance.movimento-index', [
            'headers' => $this->headers(),
            'movimentos' => $this->movimentos(),
            'movimento_grupos' => MovimentoGrupo::orderBy('nome')->get(['id', 'nome as name']),
            'pgto_tipos' => PgtoTipo::orderBy('nome')->get(['id', 'nome as name']),
            'pgto_tipo' => [
                ['id' => '1', 'name' => 'C'], ['id' => '2', 'name' => 'D']
            ],
        ]);
    }
}
