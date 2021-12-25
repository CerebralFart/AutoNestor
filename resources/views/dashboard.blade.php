@extends('layout.base')

@php
    use App\Models\Week;
    $weeks = [
        'Vorige week' => Week::current()->previous,
        'Deze week' => Week::current(),
        'Volgende week' => Week::current()->next,
    ]
@endphp

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white rounded shadow p-4 mt-6">
        <h3 class="text-xl font-light mb-2">Schoonmaaktaken</h3>
        <table>
            <thead>
            <tr>
                <td></td>
                @foreach(\App\Models\User::all() as $user)
                    <td @class([
                        "px-2",
                        "bg-blue-100" => $user->id === auth()->id()
                    ])>
                        {{$user->name}}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($weeks as $label => $week)
                <tr>
                    <td class="pr-2">
                        {{$label}}<br/>
                        <small class="font-sm">{{$week->label}}</small>
                    </td>
                    @if($week->is_holiday)
                        <td
                            class="bg-gray-100"
                            colspan="{{\App\Models\User::count()}}"
                        >
                            <div class="flex flex-row justify-center space-x-3">
                                <span>🎉</span>
                                <span>Vakantie!</span>
                                <span>🎉</span>
                            </div>
                        </td>
                    @else
                        @foreach(\App\Models\User::all() as $user)
                            <td @class([
                                "p-2",
                                "bg-blue-100" => $user->id === auth()->id()
                            ])>
                                {{$user->assignmentForWeek($week)?->task->name ?? 'Geen taak'}}
                            </td>
                        @endforeach
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
