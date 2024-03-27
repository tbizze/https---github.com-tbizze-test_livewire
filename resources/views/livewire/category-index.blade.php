<div>
    <x-mary-header title="Categories" subtitle="Latest categories">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" />
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showModal()" />
        </x-slot:actions>
    </x-mary-header>

    {{-- You can use any `$wire.METHOD` on `@row-click` --}}
    <x-mary-table :headers="$headers" :rows="$categories" striped @row-click="$wire.edit($event.detail.id)">
        @scope('header_id', $header)
            <span class=" text-lg text-gray-600">{{ $header['label'] }}</span>
        @endscope
        @scope('header_title', $header)
            <span class=" text-lg text-gray-600">{{ $header['label'] }}</span>
        @endscope
        @scope('header_slug', $header)
            <span class=" text-lg text-gray-600">{{ $header['label'] }}</span>
        @endscope
        @scope('header_description', $header)
            <span class=" text-lg text-gray-600">{{ $header['label'] }}</span>
        @endscope
        @scope('actions', $post)
            <x-mary-button icon="o-trash" wire:click="confirmDelete({{ $post->id }})" spinner class="btn-sm btn-outline border-none text-error p-1" />
        @endscope
    </x-mary-table>



    <x-mary-modal wire:model="categoryModal" class="backdrop-blur">
        <x-mary-form wire:submit="save">
            <x-mary-input label="Title" wire:model="form.title" />
            <x-mary-textarea label="Description" wire:model="form.description" hint="Max. 250 caracteres"
                rows="3" />

            <x-slot:actions>
                <x-mary-button label="Cancel" @click="$wire.categoryModal = false" />
                <x-mary-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <x-mary-modal wire:model="confirmDeleteModal" class="backdrop-blur">

        <div class="mb-5">Deseja realmente excluir o <span class=" font-bold">registro nº [{{ $registro_id }}]</span>?</div>
        <x-slot:actions>
            <x-mary-button label="Cancel" @click="$wire.confirmDeleteModal = false" />
            <x-mary-button label="Excluir" wire:click="delete({{ $registro_id }})" class="btn-error" spinner="save" />
        </x-slot:actions>

    </x-mary-modal>
</div>
