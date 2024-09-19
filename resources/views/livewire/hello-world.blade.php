<div>
    <div class="mb-6">
        <h4 class="text-lg">Vista de hello.world</h4>
    </div>
    <div class="">
        <x-input wire:model.live=name type="text" />
    <x-button wire:click='enter(x = $name)'>Enviar</x-button>
    </div>
    <div class="mt-4">
        {{ $name }}
    </div>
    
</div>
