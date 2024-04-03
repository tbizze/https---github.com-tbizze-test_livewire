<div>
    {{-- Cabeçalho da página --}}
    <x-mary-header :title="$page_title" subtitle="Últimos registros">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Pesquisar..." wire:model.live="search" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" wire:click="showDrawer = true" class="relative">
                @if ($qdeFilter > 0)
                    <x-mary-badge :value="$qdeFilter" class="badge-error absolute -right-2 -top-2" />
                @endif
            </x-mary-button>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModalRegistro()" />
        </x-slot:actions>
    </x-mary-header>

    {{-- Renderiza tabela --}}
    <x-mary-card shadow class=" bg-white">
        <x-mary-table :headers="$headers" :rows="$faturas" striped @row-click="$wire.edit($event.detail.id)" with-pagination
            :sort-by="$sortBy" class="table-sm">
            {{-- Personaliza / formata células  --}}
            @scope('cell_valor_fatura', $fatura)
                R$ {{ currency_get_db($fatura->valor_fatura) }}
            @endscope
            @scope('cell_valor_pgto', $fatura)
                @if($fatura->valor_pgto > 0)
                    R$ {{ currency_get_db($fatura->valor_pgto) }}
                @endif
            @endscope
            @scope('cell_dt_venc', $fatura)
                {{ $fatura->dt_venc->format('d/m/Y') }}
            @endscope
            @scope('cell_dt_pgto', $fatura)
                @isset($fatura->dt_pgto)
                    {{ $fatura->dt_pgto->format('d/m/Y') }}
                @endisset
            @endscope

            {{-- Monta coluna de ações  --}}
            @scope('actions', $fatura)
                <div class="flex gap-1">
                    <x-mary-button icon="o-document-duplicate" wire:click="copyRecord({{ $fatura->id }})" spinner
                        class="btn-sm btn-outline border-none p-1" />
                    <x-mary-button icon="o-trash" wire:click="confirmDelete({{ $fatura->id }})" spinner
                        class="btn-sm btn-outline border-none text-error p-1" />
                </div>
            @endscope
        </x-mary-table>
    </x-mary-card>


    {{-- MODAL: Confirma delete --}}
    <x-mary-modal wire:model="modalConfirmDelete" title="Deletar registro" class="backdrop-blur">
        <div class="mb-5">Deseja realmente excluir o <span class=" font-bold">registro nº
                [{{ $registro_id }}]</span>?</div>
        <x-slot:actions>
            <x-mary-button label="Cancel" @click="$wire.modalConfirmDelete = false" />
            <x-mary-button label="Excluir" wire:click="delete({{ $registro_id }})" class="btn-error" spinner="save" />
        </x-slot:actions>
    </x-mary-modal>

    {{-- Drawer Right -> FILTRAR --}}
    <x-mary-drawer title="Filtros" wire:model="showDrawer" with-close-button right class=" w-1/3 lg:w-2/6">
        <x-mary-form wire:submit="filtrar">
            <x-mary-input label="Hist./Notas" placeholder="Digite uma pesquisa..." wire:model="search" />
            <x-mary-select label="Emissora" :options="$fatura_emissoras" wire:model="fil_emissora" placeholder="Selecione..." />
            <x-mary-select label="Forma pgto." :options="$pgto_tipos" wire:model="fil_pgto_tipo" placeholder="Selecione..." />
            <x-mary-select label="Status" :options="$status" wire:model="fil_status" placeholder="Selecione..." />
            {{-- <div class="flex justify-between gap-2">
                <div class="w-1/2">
                    <x-mary-datepicker label="Data início" wire:model="date_init" icon-right="o-calendar"
                        :config="$date_config" />
                </div>
                <div class="w-1/2">
                    <x-mary-datepicker label="Data fim" wire:model="date_end" icon-right="o-calendar"
                        :config="$date_config" />
                </div>
            </div> --}}
            <x-slot:actions>
                <x-mary-button label="Limpar" @click="$wire.limpaFiltros()" />
                <x-mary-button label="Filtrar" type="submit" icon="o-check" class="btn-primary" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-drawer>

    {{--  Currency  --}}
    @assets
        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/robsontenorio/mary@0.44.2/libs/currency/currency.js">
        </script>
        {{-- Flatpickr  --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endassets
</div>
