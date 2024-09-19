<div class="">
        <h4 class="text-lg py-4">Vista de create.post</h4>
        {{-- {{$title}} --}}
        {{-- {{ $user->name }} --}}

        <li>{{ $id }}</li>
        <li>{{ $name }}</li>
        <li>{{ $email }}</li>
        <h4 class="text-lg py-4">Vista create.post save()</h4>
        <x-input type='text' wire:model.live='name' ></x-input>
        <x-button wire:click='save'>Save</x-button>
        

  

        {{-- @foreach ($user as $user)
           <li>{{ $name }}</li>
        @endforeach --}}

</div>
