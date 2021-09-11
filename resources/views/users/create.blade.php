@extends('layout.base')

@section('title', 'Gebruiker aanmaken')

@section('content')
    <form class="flex flex-col gap-2 mt-4" method="POST">
        <x-form.text
            id="name"
            name="Naam"
        />
        <x-form.text
            id="email"
            name="E-mailadres"
        />
        <x-form.text
            id="password"
            type="password"
            name="Wachtwoord"
        />
        @csrf
        <div class="flex flex-row justify-end">
                <x-button type="submit" color="green">
                    Opslaan
                </x-button>
        </div>
    </form>
@endsection
