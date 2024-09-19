<div>
    <h4 class="text-lg py-4">Vista de contador</h4>
    <x-button wire:click='decrement'>-</x-button> 
    <span class="p-2">
        {{$contador}}
    </span>
    
    <x-button wire:click='increment'>+</x-button>
</div>
