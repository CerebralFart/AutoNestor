@extends('layout.base')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white rounded shadow p-4 mt-6">
        <h3 class="text-xl font-light mb-2">Schoonmaaktaken</h3>
        <table>
            <thead>
            <tr>
                <td></td>
                <td class="px-2">
                    Vorige week<br/>
                    <small>{{\App\Models\Week::current()->previous->label}}</small>
                </td>
                <td class="px-2">
                    Deze week<br/>
                    <small>{{\App\Models\Week::current()->label}}</small>
                </td>
                <td class="px-2">
                    Volgende week<br/>
                    <small>{{\App\Models\Week::current()->next->label}}</small>
                </td>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Models\User::all() as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td class="px-2">{{$user->assignmentForWeek(\App\Models\Week::current()->previous)?->task->name ?? 'Geen taak'}}</td>
                    <td class="px-2">{{$user->assignmentForWeek(\App\Models\Week::current())?->task->name ?? 'Geen taak'}}</td>
                    <td class="px-2">{{$user->assignmentForWeek(\App\Models\Week::current()->next)?->task->name ?? 'Geen taak'}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
