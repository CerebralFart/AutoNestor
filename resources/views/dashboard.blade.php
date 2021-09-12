@extends('layout.base')

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
            <tr>
                <td class="pr-2">
                    Vorige week<br/>
                    <small class="font-sm">{{\App\Models\Week::current()->previous->label}}</small>
                </td>
                @foreach(\App\Models\User::all() as $user)
                    <td @class([
                        "p-2",
                        "bg-blue-100" => $user->id === auth()->id()
                    ])>
                        {{$user->assignmentForWeek(\App\Models\Week::current()->previous)?->task->name ?? 'Geen taak'}}
                    </td>
                @endforeach
            </tr>
            <tr>
                <td class="pr-2">
                    Deze week<br/>
                    <small class="font-sm">{{\App\Models\Week::current()->label}}</small>
                </td>
                @foreach(\App\Models\User::all() as $user)
                    <td @class([
                        "p-2",
                        "bg-blue-100" => $user->id === auth()->id()
                    ])>
                        {{$user->assignmentForWeek(\App\Models\Week::current())?->task->name ?? 'Geen taak'}}
                    </td>
                @endforeach
            </tr>
            <tr>
                <td class="pr-2">
                    Volgende week<br/>
                    <small class="font-sm">{{\App\Models\Week::current()->next->label}}</small>
                </td>
                @foreach(\App\Models\User::all() as $user)
                    <td @class([
                        "p-2",
                        "bg-blue-100" => $user->id === auth()->id()
                    ])>
                        {{$user->assignmentForWeek(\App\Models\Week::current()->next)?->task->name ?? 'Geen taak'}}
                    </td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@endsection
