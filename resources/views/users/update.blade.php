@extends('layout.base')

@section('title', 'Gebruiker \'' . $item->name . '\' bewerken')

@section('buttons')
    @can('delete', $item)
        <form method="POST" action="{{route('users.delete', ['id' => $item->id])}}" class="m-0">
            @csrf
            <x-button
                color="red"
                icon="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                type="submit"
            >
                Verwijderen
            </x-button>
        </form>
    @endif
@endsection

@section('content')
    <form class="flex flex-col gap-2 mt-4" method="POST">
        <x-form.text
            id="name"
            name="Naam"
            value="{{$item->name}}"
        />
        <x-form.text
            id="email"
            name="E-mailadres"
            value="{{$item->email}}"
        />
        <x-form.select
            id="role"
            name="Rol"
            :value="$item->role"
            :options="['admin' => 'Administrator', 'user' => 'Gebruiker']"
        />
        @csrf
        <div class="flex flex-row justify-end">
            <x-button type="submit" color="green">
                Opslaan
            </x-button>
        </div>
    </form>
@endsection
