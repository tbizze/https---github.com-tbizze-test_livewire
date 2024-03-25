<div class="">
    {{-- The best athlete wants his opponent at his best. --}}
    {{-- <h1 class="my-3 text-2xl">{{ $count }}</h1>
    <h1 class="my-3 text-2xl">{{ $search }}</h1>

    <button wire:click="increment" class="py-1 px-3 bg-slate-700 hover:bg-slate-800 text-white">+</button>

    <button wire:click="decrement" class="py-1 px-3 bg-slate-700 hover:bg-slate-800 text-white">-</button>

    <input wire:model.live="search" class=" rounded-md">

    <x-secondary-button class="mt-2 me-2" type="button" wire:click="confirming=true">
        {{ __('Select A New Photo') }}
    </x-secondary-button> --}}

    <div class="flex flex-col">
        <h2 class="mb-4 text-2xl font-bold">Feature Cards</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">1823 Users</h2>
                    <p class="mt-2 text-sm text-gray-500">Last checked 3 days ago</p>
                </div>
            </div>
            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">1823 Users</h2>
                    <p class="mt-2 text-sm text-gray-500">Last checked 3 days ago</p>
                </div>
            </div>
            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">1823 Users</h2>
                    <p class="mt-2 text-sm text-gray-500">Last checked 3 days ago</p>
                </div>
            </div>
            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                <div
                    class="flex h-12 w-12 items-center justify-center rounded-full border border-orange-100 bg-orange-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-4">
                    <h2 class="font-semibold">1823 Users</h2>
                    <p class="mt-2 text-sm text-gray-500">Last checked 3 days ago</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex min-h-screen items-center justify-center">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-xl">
                <thead>
                    <tr class="bg-blue-gray-100 text-gray-700">
                        <th class="py-3 px-4 text-left">Nome</th>
                        <th class="py-3 px-4 text-left">Verificado</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Token</th>
                        <th class="py-3 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-blue-gray-900">
                    @foreach ($users as $user)
                        <tr class="border-b border-blue-gray-200">
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email_verified_at }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">{{ $user->remember_token }}</td>
                            <td class="py-3 px-4">
                                <a href="#" class="font-medium text-blue-600 hover:text-blue-800">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <x-confirmation-modal wire:model="confirming">
        <x-slot name="title">
            Delete Account
        </x-slot>

        <x-slot name="content">
            Você confirma a exclusão deste registro? Once your account is deleted, all of its resources and data will be
            permanently deleted.
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                Apagar conta
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

</div>
