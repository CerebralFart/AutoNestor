@extends('layout.base')

@section('title', 'Taak aanmaken')

@section('content')
    <form class="flex flex-col gap-2 mt-4" method="POST" action="{{route('tasks.store')}}">
        <x-form.text
            id="name"
            name="Naam"
        />
        <x-form.textarea
            id="description"
            name="Omschrijving"
        />
        <x-form.multi-select
            id="vetoers"
            name="Veto's"
            :values="$task->vetoers->pluck('id')->all()"
            :options="collect(\App\Models\User::all())->pluck('name','id')->all()"
        />
        @csrf
        <div class="flex flex-row justify-end">
            <x-button type="submit" color="green">
                Opslaan
            </x-button>
        </div>
    </form>
@endsection
