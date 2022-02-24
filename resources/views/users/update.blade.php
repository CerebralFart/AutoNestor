@extends('layout.base')

@section('title', 'Gebruiker \'' . $user->name . '\' bewerken')

@section('buttons')
    @can('delete', $user)
        <form method="POST" action="{{route('users.destroy', ['user' => $user->id])}}" class="m-0">
            @method('DELETE')
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
    <form class="flex flex-col gap-2 mt-4" method="POST" action="{{route('users.update', ['user' => $user])}}">
        @method('PUT')
        <x-form.text
            id="name"
            name="Naam"
            value="{{$user->name}}"
        />
        <x-form.text
            id="email"
            name="E-mailadres"
            value="{{$user->email}}"
        />
        <x-form.select
            id="role"
            name="Rol"
            :value="$user->role"
            :options="['admin' => 'Administrator', 'user' => 'Gebruiker']"
        />
        <x-form.multi-select
            id="vetos"
            name="Veto's"
            :values="$user->vetos->pluck('id')->all()"
            :options="collect(\App\Models\Task::all())->pluck('name','id')->all()"
        />
        @csrf
        <div class="flex flex-row justify-end">
            <x-button type="submit" color="green">
                Opslaan
            </x-button>
        </div>
    </form>
@endsection
