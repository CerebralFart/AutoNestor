@extends('layout.no-layout')

@section('body')
    @include('layout.menu')
    <div class="bg-gray-100 ml-60 min-h-screen">
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                @hasSection('title')
                    <div class="max-w-5xl mx-auto px-4 sm:px-6 md:px-8 mb-6 flex flex-row gap-2 items-center">
                        <h1 class="text-2xl font-light text-gray-900">@yield('title')</h1>
                        @hasSection('buttons')
                            <div class="flex-grow"></div>
                            @yield('buttons')
                        @endif
                    </div>
                @endif
                <div class="max-w-5xl mx-auto px-4 sm:px-6 md:px-8">
                    @hasSection('content')
                        @yield('content')
                    @else
                        <div class="py-4">
                            <div class="border-4 border-dashed border-gray-300 rounded-lg h-96"></div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
