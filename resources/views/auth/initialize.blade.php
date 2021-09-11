@extends('layout.no-layout')

@section('title','Maak een account')

@section('body')
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Maak een account
                    </h2>
                    <h4 class="mt-1 text-gray-700">
                        Er zijn nog geen andere accounts
                    </h4>
                </div>

                <form method="POST" class="mt-8 space-y-6">
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
                    <div>
                        <x-button type="submit" block>
                            Aanmaken
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover object-right" src="https://images.unsplash.com/photo-1580063665747-ab495581c9c1?auto=format&fit=crop&q=80" alt="">
        </div>
    </div>

@endsection
