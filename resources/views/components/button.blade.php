@php
    $colors = [
        'blue' => [
            'primary' => 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500',
        ],
        'green' => [
            'primary' => 'bg-green-600 hover:bg-green-700 focus:ring-green-500',
        ],
        'red' => [
            'primary' => 'bg-red-600 hover:bg-red-700 focus:ring-red-500'
        ]
    ];
@endphp


<button
    @class([
        'py-2 border border-transparent font-bold text-center rounded-md shadow-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2',
        $colors[$attributes->get('color', 'blue')][$attributes->get('weight', 'primary')],
        'pl-4 pr-2' => $attributes->has('icon'),
        'px-4' => !$attributes->has('icon'),
        'w-full' => $attributes->has('block'),
        'inline-flex' => !$attributes->has('block')
    ])

    type="{{$attributes->get('type', 'button')}}"

    @if($attributes->has('href'))
    onclick="window.location.href='{{$attributes->get('href')}}'"
    @endif
>
    {{$slot}}
    @if($attributes->has('icon'))
        <svg class="pl-1 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path
                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="{{$attributes->get('icon')}}"
            />
        </svg>
    @endif
</button>
