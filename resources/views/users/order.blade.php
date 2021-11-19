@extends('layout.base')

@section('title', 'Gebruikers orderen')

@section('content')
    <form method="POST" class="flex flex-col gap-4">
        <div class="bg-white shadow overflow-hidden sm:rounded-md mt-4">
            <ul class="divide-y divide-gray-200"
                x-data="order"
                data-items="{{json_encode($items->toArray())}}"
            >
                <template x-for="node in sorted">
                    <li draggable="true"
                        x-on:dragstart="startDrag(node)"
                        x-on:dragover="dragOver(event)"
                        x-on:drop="stopDrag(node, event)"
                        class="bg-white group hover:bg-gray-50 transition-colors"
                    >
                        <div class="pr-4 py-4 sm:pr-6 flex flex-row">
                            <div class="mx-2 text-gray-500 cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                <div class="truncate block flex gap-2">
                                    <p class="font-medium text-blue-600 truncate" x-text="node.name"></p>
                                    <p class="flex-shrink-0 font-normal text-gray-500" x-text="node.email"></p>
                                </div>
                            </div>
                            <div class="flex-grow flex flex-row gap-2 justify-end items-center">
                                <svg x-on:click="moveUp(node)" class="w-6 h-6 text-gray-500 cursor-pointer group-first-of-type:text-gray-200 group-first-of-type:cursor-not-allowed" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                </svg>
                                <svg x-on:click="moveDown(node)" class="w-6 h-6 text-gray-500 cursor-pointer group-last-of-type:text-gray-200 group-last-of-type:cursor-not-allowed" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <input
                            name="users[]"
                            x-model="node.id"
                            class="hidden"
                        />
                    </li>
                </template>
            </ul>
        </div>
        @csrf
        <div class="flex flex-row justify-end">
            <x-button type="submit" color="green">
                Opslaan
            </x-button>
        </div>
    </form>
@endsection
