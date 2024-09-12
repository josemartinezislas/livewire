<div>
    <div class=" text-slate-700  rounded-lg border-2 p-8 bg-slate-50 shadow-sm flex flex-col">
        <h4 class="text-lg py-4">View formulario</h4>
        <form wire:submit='save'>
            <div class="mb-4">
                <x-label>
                    Name
                </x-label>
                <x-input wire:model='title' required class="w-full"></x-input>
            </div>
            <div class="mb-4">
                <x-label>
                    Content
                </x-label>
                <x-textarea wire:model='content' required class="w-full"></x-textarea>
            </div>
            <div class="mb-4">
                <x-label>
                    Category
                </x-label>
                <x-select wire:model='category_id' class="w-full">
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label>
                    Labels
                </x-label>

                @foreach ($tags as $tag)
                    <li class="list-none">
                        <label>
                            <x-checkbox wire:model='selectedTags' value="{{ $tag->id }}" />
                            {{ $tag->name }}
                        </label>
                    </li>
                @endforeach
            </div>
            <div class="flex justify-end">
                <x-button>create</x-button>
            </div>
        </form>
    </div>

    <div class=" text-slate-700  rounded-lg border-2 p-8 my-2 bg-slate-50 shadow-sm flex flex-col">
        @foreach ($posts as $post)
            <ul class=" ">
                <li class=" flex flex-row justify-between py-1" wire:key='post-{{ $post->id }}'>
                    {{ $post->title }}
                    <div>
                        <x-button wire:click='edit({{ $post->id }})'>Edit</x-button>
                        <x-danger-button wire:click='destroy({{ $post->id }})'>Delete</x-danger-button>
                    </div>

                </li>
            </ul>
        @endforeach
    </div>



    {{-- MODAL formulario edicion --}}
    {{-- @if ($open)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 ">
            <div class="py-12">
                <div class="max-w-xl mx-auto sm:px-8 lg:px-10">
                    <div class=" text-slate-700  rounded-lg border-2 p-8 my-2 bg-slate-50 shadow-sm flex flex-col">
                        <form wire:submit='update'>
                            <div class="mb-4">
                                <x-label>
                                    Name
                                </x-label>
                                <x-input wire:model='postEdit.title' required class="w-full"></x-input>
                            </div>
                            <div class="mb-4">
                                <x-label>
                                    Content
                                </x-label>
                                <x-textarea wire:model='postEdit.content' required class="w-full"></x-textarea>
                            </div>
                            <div class="mb-4">
                                <x-label>
                                    Category
                                </x-label>
                                <x-select wire:model='postEdit.category_id' class="w-full">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="mb-4">
                                <x-label>
                                    Labels
                                </x-label>

                                @foreach ($tags as $tag)
                                    <li class="list-none">
                                        <label>
                                            <x-checkbox wire:model='postEdit.tags' value="{{ $tag->id }}" />
                                            {{ $tag->name }}
                                        </label>
                                    </li>
                                @endforeach
                            </div>
                            <div class="flex justify-end">
                                <x-danger-button wire:click="$set('open', false)" class="mr-2">close</x-danger-button>
                                <x-button>update</x-button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    @endif --}}
    <form wire:submit='update'>
        <x-dialog-modal wire:model='open'>
            <x-slot name='title'>
                Update Post
            </x-slot>
            <x-slot name='content'>

                <div class="mb-4">
                    <x-label>
                        Name
                    </x-label>
                    <x-input wire:model='postEdit.title' required class="w-full"></x-input>
                </div>
                <div class="mb-4">
                    <x-label>
                        Content
                    </x-label>
                    <x-textarea wire:model='postEdit.content' required class="w-full"></x-textarea>
                </div>
                <div class="mb-4">
                    <x-label>
                        Category
                    </x-label>
                    <x-select wire:model='postEdit.category_id' class="w-full">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="mb-4">
                    <x-label>
                        Labels
                    </x-label>

                    @foreach ($tags as $tag)
                        <li class="list-none">
                            <label>
                                <x-checkbox wire:model='postEdit.tags' value="{{ $tag->id }}" />
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                </div>
            </x-slot>
            <x-slot name='footer'>
                <div class="flex justify-end">
                    <x-danger-button wire:click="$set('open', false)" class="mr-2">close</x-danger-button>
                    <x-button>update</x-button>
                </div>
            </x-slot>
        </x-dialog-modal>

    </form>

</div>
