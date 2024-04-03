<div>
    <div class=" flex gap-5">
        <x-mary-card title="Últimos débitos" shadow class="w-1/3">
            @foreach ($movtos_d as $movimento)
                <x-mary-list-item :item="$movimento" no-hover>
                    <x-slot:value>
                        {{ $movimento->historico }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        {{ $movimento->dt_movimento->format('d/m/Y') }}
                    </x-slot:sub-value>
                    <x-slot:actions>
                        {{ $movimento->valor }}
                    </x-slot:actions>
                </x-mary-list-item>
            @endforeach
            <x-slot:actions>
                <x-mary-button label="Ver todos" class=" btn-secondary btn-sm" link="{{ route('movimentos') }}" spinner="save" />
            </x-slot:actions>
        </x-mary-card>

        <x-mary-card title="Últimos créditos" shadow class="w-1/3">
            @foreach ($movtos_c as $movimento)
                <x-mary-list-item :item="$movimento" no-hover>
                    <x-slot:value>
                        {{ $movimento->historico }}
                    </x-slot:value>
                    <x-slot:sub-value>
                        {{ $movimento->dt_movimento->format('d/m/Y') }}
                    </x-slot:sub-value>
                    <x-slot:actions>
                        {{ $movimento->valor }}
                    </x-slot:actions>
                </x-mary-list-item>
            @endforeach
            <x-slot:actions>
                <x-mary-button label="Ver todos" class=" btn-secondary btn-sm" link="{{ route('movimentos') }}" spinner="save" />
            </x-slot:actions>
        </x-mary-card>

        <x-mary-card title="Últimos movimentos" shadow class="w-1/3">
            @foreach ($movtos_d as $movimento)
                <x-mary-list-item :item="$movimento" value="valor" sub-value="historico" />
            @endforeach
        </x-mary-card>
    </div>

</div>
