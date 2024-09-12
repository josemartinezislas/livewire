<div>
    <h4 class="text-lg py-4">Vista paises</h4>
    @livewire('hijo')

    <x-button wire:click="$set('count', 0 )" class="my-5">reset</x-button>
    <x-button wire:click="$toggle('open')" class="my-5">open/close</x-button>


    <form wire:submit='save'>
        <x-input wire:model='pais' wire:keydown.space='increment' placeholder='Ingrese país' />
        <x-button>Agergar</x-button>
        @if($open)
        <ul class="list-disc list-inside mt-4">
            @foreach ($paises as $index => $pais)
                <li wire:key='pais-{{ $index }}' class="my-4">
                    <span wire:mouseenter="changeActive('{{ $pais }}')" class=" mr-4 ">
                        {{ $index }} {{ $pais }}
                    </span>
                    <x-danger-button wire:click='delete({{ $index }})'>Delete</x-danger-button>
                </li>
            @endforeach

        </ul>
        @endif
    </form>


    {{-- <span>{{ $active }} </span> --}}
    <span>{{ $count }} </span>
</div>
