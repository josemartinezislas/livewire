<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>
    <style>
        .itr {
            border: 1px dashed red;
        }

        .itg {
            border: 1px dashed green;
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('comments')
            @livewire('formulario')

            {{-- <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
                @livewire('paises')
            </div>

            <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
                @livewire('hello-world')
            </div>

            <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
                @livewire('create-post', [
                    'title' => 'Title desde Dasboard',
                    'user' => 3
                ])
            </div>
            <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
                @livewire('contador')
            </div> --}}

            {{-- @livewire('crea-tarjeta') --}}

            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div> --}}
        </div>
    </div>
</x-app-layout>
