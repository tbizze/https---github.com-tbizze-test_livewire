<div class="py-12">
    <div class="max-w-7xl mx-auto bg-white sm:px-6 lg:px-8">
        
        
        <x-mary-header title="Users" subtitle="Check this on mobile">
            <x-slot:middle class="!justify-end">
                <x-mary-input icon="o-magnifying-glass" placeholder="Search..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button icon="o-funnel" />
                <x-mary-button icon="o-plus" class="btn-primary" />
            </x-slot:actions>
        </x-mary-header>



        <x-mary-tabs selected="users-tab">
            <x-mary-tab name="users-tab" label="Users" icon="o-users">
                <div>Users</div>
            </x-mary-tab>
            <x-mary-tab name="tricks-tab" label="Tricks" icon="o-sparkles">
                <div>Tricks</div>
            </x-mary-tab>
            <x-mary-tab name="musics-tab" label="Musics" icon="o-musical-note">
                <div>Musics</div>
            </x-mary-tab>
        </x-mary-tabs>

        {{--  COLOR AND STYLE --}}
        <x-mary-button label="Hi!" class="btn-outline" />
        <x-mary-button label="How" class="btn-warning" />
        <x-mary-button label="Are" class="btn-success" />
        <x-mary-button label="You?" class="btn-error btn-sm" />

        {{-- SLOT --}}
        <x-mary-button class="btn-primary">
            With default slot 😃
        </x-mary-button>
        <x-mary-button class=" btn-secondary">
            With default slot 😃
        </x-mary-button>

        {{-- CIRCLE --}}
        <x-mary-button icon="o-user" class="btn-circle" />
        <x-mary-button icon="o-user" class="btn-circle btn-outline" />

        {{-- SQUARE --}}
        <x-mary-button icon="o-user" class="btn-circle btn-ghost" />
        <x-mary-button icon="o-user" class="btn-square" />

        <x-mary-form wire:submit="save">
            <x-mary-input label="Name" wire:model="name" />
            <x-mary-input label="Amount" wire:model="search" prefix="USD" money hint="It submits an unmasked value" />
         
            <x-slot:actions>
                <x-mary-button label="Cancel" />
                <x-mary-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </div>
</div>
