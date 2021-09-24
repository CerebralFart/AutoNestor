@extends('layout.base')

@section('title', 'Gebruikers')

{{--TODO add policy checks to links--}}

@section('buttons')
    @can('create', \App\Models\User::class)
        <x-button
            href="{{route('users.create')}}"
            icon="M12 6v6m0 0v6m0-6h6m-6 0H6"
        >
            Nieuw
        </x-button>
    @endif
@endsection

@section('content')
    <div class="bg-white shadow overflow-hidden sm:rounded-md mt-4">
        <ul role="list" class="divide-y divide-gray-200">
            @foreach($items as $item)
                <li class="bg-white hover:bg-gray-50 transition-colors">
                    <div class="px-4 py-4 sm:px-6 flex flex-row">
                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                            <div class="truncate">
                                <a href="{{route('users.show', ['id' => $item->id])}}" class="block flex gap-2">
                                    <p class="font-medium text-blue-600 truncate">{{$item->name}}</p>
                                    <p class="flex-shrink-0 font-normal text-gray-500">
                                        {{$item->email}}
                                    </p>
                                    @if($item->password)
                                        <p class="inline-flex items-center" title="{{$item->name}} kan inloggen">
                                            <svg
                                                class="mt-1 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                                ></path>
                                            </svg>
                                        </p>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="flex-grow flex flex-row gap-2 justify-end items-center">
                            @can('update', $item)
                                <a href="{{route('users.update', ['id' => $item->id])}}">
                                    <svg class="h-5 w-5 text-gray-400 hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            @endcan
                            @can('delete',$item)
                                <form method="POST" action="{{route('users.delete', ['id' => $item->id])}}" class="m-0">
                                    @csrf
                                    <button type="submit" class="h-5">
                                        <svg class="h-5 w-5 text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
