@php
    $colors = [
        'blue' => [
            'primary' => 'bg-blue-600 hover:bg-blue-700',
        ],
        'green' => [
            'primary' => 'bg-green-600 hover:bg-green-700',
        ],
        'red' => [
            'primary' => 'bg-red-600 hover:bg-red-700'
        ]
    ];
@endphp

<button
    type="{{$attributes->get('type', 'button')}}"

    @if($attributes->has('href'))
    onclick="window.location.href='{{$attributes->get('href')}}'"
    @endif

    {{ $attributes->class([
        'h-10 py-2 font-bold text-center shadow-sm text-white focus:outline-none',
        $colors[$attributes->get('color', 'blue')][$attributes->get('weight', 'primary')],
        ($slot->isEmpty() ? 'pl-2' : 'pl-4'),
        ($attributes->has('icon') ? 'pr-2' : 'pr-4'),
        ($attributes->has('block') ? 'w-full' : 'inline-flex'),
        'rounded-md' => $attributes->get('context') !== 'group',
    ])->except(['type','weight','icon','block','context']) }}
>
    {{$slot}}
    @if($attributes->has('icon'))
        <svg @class(["h-full", "pl-1" => !$slot->isEmpty()]) fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="{{$attributes->get('icon')}}"
            />
        </svg>
    @endif
</button>
