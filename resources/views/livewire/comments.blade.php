<div>

    @if (count($comments))
        <div  class=" text-blue-900 rounded-lg border-2 p-3 bg-blue-200 border-blue-300 mb-2 shadow-sm flex flex-col">
            @foreach ($comments as $comment)
                <ul>
                    <li>
                        <p class="text-center">
                            {{ $comment }}
                        </p>
                    </li>
                </ul>
            @endforeach
        </div>
    @endif

</div>