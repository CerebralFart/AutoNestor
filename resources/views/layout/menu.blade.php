@php
    // TODO add permission checks
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;

    $routes = [
        'Home'=>[
            'dashboard',
            'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'
        ],
        'Gebruikers' => [
            'users',
            'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
        ],
        'Taken' => [
            'tasks',
            'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4'
        ]
    ];

    foreach($routes as &$data){
        $data[] = Str::startsWith(Route::currentRouteName(), $data[0]);
    }
@endphp

<div
    class="fixed h-screen px-2 py-4 flex flex-col gap-1 transition-all shadow bg-white overflow-hidden z-10 md:w-60"
    :class="open ? 'w-60' : 'w-14'"
    x-data="{open: false}"
    @click.outside="open = false"
>
    <div
        class="cursor-pointer md:hidden"
        @click="open = !open"
    >
        <svg
            class="ml-2 mb-2 flex-shrink-0 h-6 w-6 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                x-show="!open"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 8h16M4 16h16"
            ></path>
            <path
                x-show="open"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
            ></path>
        </svg>
    </div>
    @foreach($routes as $name => [$route, $icon, $active])
        <a
            @class([
                'text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-lg',
                'bg-gray-100' => $active,
                'hover:bg-gray-100' => !$active,
            ])
            href="{{route($route)}}"
        >
            <svg
                @class([
                    'mr-4 flex-shrink-0 h-6 w-6',
                    'text-gray-500' => $active,
                    'group-hover:text-gray-500 text-gray-400' => !$active
                ])
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="{{$icon}}"
                />
            </svg>
            {{$name}}
        </a>
    @endforeach

    <div class="flex-grow"></div>

    <div class="flex-shrink-0 w-full group block">
        <div class="flex items-center">
            <div class="ml-1">
                <svg class="h-9 w-9 bg-blue-200 text-gray-800 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-2">
                @if(auth()->check())
                    <p class="text-sm font-medium text-gray-900">
                        {{auth()->user()->name}}
                    </p>
                    <a href="{{route('logout')}}" class="text-xs font-medium text-gray-600 group-hover:text-gray-700">
                        Uitloggen
                    </a>
                @else
                    <a href="{{route('login')}}" class="font-medium text-gray-600 group-hover:text-gray-700">
                        Inloggen
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
