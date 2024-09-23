<div>
@php
    
    $color = 'yellow';
@endphp
   
    <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm mb-2 flex justify-between">
        View table
        {{-- BUTTON NUEVO POST --}}
        <x-button color="$color" wire:click="$set('formCreate.openSave', true)" >Nuevo post</x-button>


        <x-alert type="danger">
            <x-slot:title>
                Titulo alert !
            </x-slot>
            Info
        </x-alert>


    </div>
    {{-- T A B L A --}}
    <div wire:poll.200s class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
        <div class="mb-8">
            <x-input wire:model.live='search' placeholder='Search by Id ...' class="w-full"></x-input>
        </div>
        @foreach ($posts as $post)
            <ul class="divide-dashed divide-gray-100 border-y ">
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex justify-between w-full">
                        <div class="flex min-w-0 gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold leading-6 text-gray-900">ID {{ $post->id }} =>
                                    {{ $post->title }} </p>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ $post->content }}</p>
                            </div>
                        </div>
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            {{-- <p class="text-sm leading-6 text-gray-900">Categoria / {{ $post->category_id }}</p> --}}
                            <p class="text-sm leading-6 text-gray-900">Categorias / {{ $post->category->name }}</p>
                            <p class="mt-1 text-xs leading-5 text-gray-500">Creado {{ $post->created_at }}</p>
                        </div>


                    </div>
                    {{-- BUTTONS UPDATE / DELETE --}}
                    @if (Auth::user()->id == 1)
                        <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                            <x-button wire:click="edit({{ $post->id }})" class="py-0.5 my-1">Edit</x-button>

                            <x-danger-button wire:click="$dispatch('deletePost', { postId: {{ $post->id }} })"
                                class="py-0.5 my-1">Delete</x-button>
                        </div>
                    @else
                    @endif


                </li>
            </ul>
        @endforeach
        <div class="mt-8">
            {{ $posts->links() }}
        </div>


        {{-- M O D A L   C R E A R   P O S T --}}
        <x-dialog-modal wire:model="formCreate.openSave">
            <x-slot name='title'>
                Crear post
            </x-slot>
            <x-slot name='content'>
                <form wire:submit="save">
                    <div class="mb-4">
                        <x-label> Name </x-label>
                        <x-input wire:model.live="formCreate.title" class="w-full" type="text"></x-input>
                        {{-- <x-input-error for='title' /> --}}
                        @error('formCreate.title')
                            <span class="error ">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <x-label> Content </x-label>
                        <x-textarea wire:model.live="formCreate.content" class="w-full" type="text"></x-textarea>
                        @error('formCreate.content')
                            <span class="error ">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <x-label> Category </x-label>

                        <x-select wire:model="formCreate.category_id" class="w-full">
                            <option value="">- select category -</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                        @error('formCreate.category_id')
                            <span class="error ">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="mb-4">
                        <x-label> Labels </x-label>
                        <ul>
                            @foreach ($tags as $tag)
                                <li class="list-none">
                                    <label>
                                        <x-checkbox wire:model="formCreate.tagsArray" value="{{ $tag->id }}" />
                                        {{ $tag->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        @error('formCreate.tagsArray')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- BUTTONS FORMULARIO SAVE --}}
                    <div class="flex justify-end">
                        <x-danger-button wire:click="$set('formCreate.openSave', false)"
                            class="mr-4">Cerrar</x-button>
                            <x-button>create</x-button>
                    </div>
                </form>
            </x-slot>
            <x-slot name='footer'>
            </x-slot>
        </x-dialog-modal>


        {{-- M O D A L   E D I T   P O S T --}}
        <x-dialog-modal wire:model="formEdit.openEdit">
            <x-slot name="title">
                Actualizar post
            </x-slot>
            <x-slot name="content">
                <form wire:submit="update">
                    <div class="mb-4">
                        <x-label> Name </x-label>
                        <x-input wire:model="formEdit.title" class="w-full"></x-input>
                        <x-input-error for="formEdit.title" />
                    </div>
                    <div class="mb-4">
                        <x-label> Content </x-label>
                        <x-textarea wire:model="formEdit.content" class="w-full"></x-textarea>
                        <x-input-error for="formEdit.content" />
                    </div>
                    <div class="mb-4">
                        <x-label> Category </x-label>

                        <x-select wire:model="formEdit.category_id" class="w-full">
                            <option value="">- select category -</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error for="formEdit.category_id" />

                    </div>
                    <div class="mb-4">
                        <x-label> Labels </x-label>
                        <ul>
                            @foreach ($tags as $tag)
                                <li class="list-none">
                                    <label>
                                        <x-checkbox wire:model="formEdit.tagsArray" value="{{ $tag->id }}" />
                                        {{ $tag->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <x-input-error for="formEdit.tagsArray" />
                    </div>
                    {{-- BUTTONS FORMULARIO UPDATE --}}
                    <div class="flex justify-end">
                        <x-danger-button wire:click="$set('formEdit.openEdit', false)" class="mr-4">Cerrar</x-button>
                            <x-button wire:click="update">Actualizar</x-button>
                    </div>
                </form>
            </x-slot>
            <x-slot name="footer">
            </x-slot>
        </x-dialog-modal>


    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script></script>
    @endpush

    @script
        <script>
            //https://sweetalert2.github.io/#examples
            Livewire.on('post-created', function(comment) {
                //alert(comment);
                console.log(comment[0]);
            });

            Livewire.on('deletePost', postId => {
                postId = Object.values(postId);
                postId = postId[0];
                console.log(postId);
                Swal.fire({
                    title: '¿Seguro de eliminar el registro ' + postId + ' ?',
                    text: '¡No podrás revertir esto!',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let timerInterval;
                        Swal.fire({
                            title: "Alerta!",
                            html: "Eliminando registro",
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                    timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("I was closed by the timer");
                                $wire.dispatch('delete', {
                                    postId: postId
                                });
                            }
                        });
                    }
                });
            });

            Livewire.on('alertUpdate', function(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            });

            Livewire.on('alertSave', function(message) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                        console.log('finaliza...');
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: message
                });
            });
        </script>
    @endscript

</div>
