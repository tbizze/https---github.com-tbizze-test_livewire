<?php

namespace App\Livewire\Finance;

use App\Models\Fatura;
use App\Models\FaturaEmissora;
use App\Models\PgtoTipo;
use App\Models\Status;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class FaturaIndex extends Component
{
    use Toast;
    use WithPagination;

    public array $sortBy = ['column' => 'dt_venc', 'direction' => 'desc'];
    public string $search = '';

    public bool $modalRegistro = false;
    public bool $modalConfirmDelete = false;
    public bool $showDrawer = false;
    public bool $registroEditMode = false;

    //public MovimentoForm $form;
    public $registro_id = '';
    public $qdeFilter = 0;

    /*  */
    public $page_title = 'Faturas';
    public $date_config = ['altFormat' => 'd/m/Y'];
    /* Campos de filtros */
    public $date_init = '';
    public $date_end = '';
    public $fil_emissora = '';
    public $fil_pgto_tipo = '';
    public $fil_status = '';


    // Método p/ confirmar delete.
    public function confirmDelete($id)
    {
        $this->registro_id = $id;
        $this->modalConfirmDelete = true;
    }

    // Método para deletar.
    public function delete($id)
    {
        Fatura::find($id)->delete();
        $this->modalConfirmDelete = false;
        $this->success('Registro excluído com sucesso!');
    }

    public function filtrar()
    {
        $this->qdeFilter = 0;
        if ($this->fil_emissora) {
            $this->qdeFilter++;
        }
        if ($this->fil_pgto_tipo) {
            $this->qdeFilter++;
        }
        if ($this->fil_status) {
            $this->qdeFilter++;
        }
        if ($this->search) {
            $this->qdeFilter++;
        }
        /* if ($this->date_init) {
            $this->qdeFilter++;
        } */

        $this->faturas();
        $this->showDrawer = false;
    }

    public function limpaFiltros()
    {
        $this->search = '';
        $this->fil_emissora = '';
        $this->fil_pgto_tipo = '';
        $this->fil_status = '';
        /* $this->date_init = '';
        $this->date_end = ''; */
        $this->showDrawer = false;
        $this->qdeFilter = 0;
    }


    /* Dados da tabela */
    public function faturas()
    {
        return Fatura::query()
            ->withAggregate('toFaturaEmissora', 'nome')
            ->withAggregate('toPgtoTipo', 'nome')
            ->withAggregate('toStatus', 'nome')
            ->orderBy(...array_values($this->sortBy))
            ->when($this->search, function ($query, $val) {
                $query->where('codigo', 'like', '%' . $val . '%');
                $query->orWhere('notas', 'like', '%' . $val . '%');
                return $query;
            })
            ->when($this->fil_pgto_tipo, function ($query, $val) {
                $query->where('pgto_tipo_id', $val);
                return $query;
            })
            ->when($this->fil_emissora, function ($query, $val) {
                $query->where('fatura_emissora_id', $val);
                return $query;
            })
            ->when($this->fil_status, function ($query, $val) {
                $query->where('status_id', $val);
                return $query;
            })
            /* ->when($this->date_init, function ($query, $val) {
                $query->whereBetween('dt_movimento', [$this->date_init, $this->date_end]);
                return $query;
            }) */
            ->paginate(10);
    }

    /* Cabeçalho da tabela */
    public function headers()
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'codigo', 'label' => 'Código'],
            ['key' => 'dt_venc', 'label' => 'Dt. Venc.'],
            ['key' => 'dt_pgto', 'label' => 'Dt. Pgto.'],
            ['key' => 'valor_fatura', 'label' => 'Valor fatura'],
            ['key' => 'valor_pgto', 'label' => 'Valor pgto.'],
            ['key' => 'to_fatura_emissora_nome', 'label' => 'Emissor', 'sortBy' => 'to_fatura_emissora_nome'],
            ['key' => 'to_pgto_tipo_nome', 'label' => 'Tipo Pgto.', 'sortBy' => 'to_pgto_tipo_nome'],
            ['key' => 'to_status_nome', 'label' => 'Status', 'sortBy' => 'to_status_nome'],
            ['key' => 'notas', 'label' => 'Notas', 'sortable' => false],
        ];
    }

    /* Renderiza componente */
    #[Title('Fatura')]
    public function render()
    {
        return view('livewire.finance.fatura-index',[
            'headers' => $this->headers(),
            'faturas' => $this->faturas(),
            'fatura_emissoras' => FaturaEmissora::orderBy('nome')->get(['id', 'nome as name']),
            'pgto_tipos' => PgtoTipo::orderBy('nome')->get(['id', 'nome as name']),
            'status' => Status::orderBy('nome')->get(['id', 'nome as name']),
        ]);
    }
}
