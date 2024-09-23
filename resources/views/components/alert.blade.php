@props(['type' => 'info'])
@php
    switch ($type) {
        case 'info':
            $class = 'bg-blue-50 text-blue-800 ';
            break;
        case 'success':
            $class = 'bg-green-50 text-green-800';
            break;
        case 'danger':
            $class = 'bg-red-50 text-red-800';
            break;
        default:
            $class = 'bg-gray-200 text-gray-700';
            break;
    }
@endphp
<div {{ $attributes->merge(['class' => 'p-4 rounded-md w-full flex justify-center '.$class]) }}>
    <span class=" font-bold "> {{ $title ?? 'Info default' }} </span> {{ $slot }}
</div>

{{-- <div class="{{ $class }} rounded-md w-full flex  justify-center">
    <span class=" font-bold "> {{ $title ?? 'Info default' }} </span> {{ $slot }}
</div> --}}