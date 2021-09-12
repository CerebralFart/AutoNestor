@extends('layout.no-layout')

@section('title','Log In')

{{--TODO reset password werkt nog niet--}}

@section('body')
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Log in in je account
                    </h2>
                    @if(isset($error))
                        <h4 class="mt-1 text-red-600">
                            {{$error}}
                        </h4>
                    @endif
                </div>

                <form method="POST" class="mt-8 space-y-6">
                    <x-form.text
                        id="email"
                        name="E-mailadres"
                        value="{{$email ?? ''}}"
                    />
                    <x-form.text
                        id="password"
                        type="password"
                        name="Wachtwoord"
                    />
                    @csrf
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-900">
                                Onthoud mij
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                                Je wachtwoord vergeten?
                            </a>
                        </div>
                    </div>

                    <div>
                        <x-button type="submit" block>
                            Inloggen
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
