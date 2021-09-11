@extends('layout.base')

@section('title', 'Gebruiker \'' . $item->name . '\'')

@section('buttons')
    @can('update', $item)
        <x-button
            href="{{route('users.update', ['id' => $item->id])}}"
            icon="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
        >
            Bewerken
        </x-button>
    @endif
    @can('delete',$item)
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
    <dl class="grid grid-cols-4 space-y-1">
        <dt class="font-bold">Name:</dt>
        <dd class="col-span-3">{{$item->name}}</dd>
        <dt class="font-bold">E-mailadres:</dt>
        <dd class="col-span-3">{{$item->email}}</dd>
        <dt class="font-bold">Authenticatie:</dt>
        <dd class="col-span-3">
            @if($item->password)
                {{$item->name ?? 'Gebruiker'}} kan inloggen
            @else
                {{$item->name ?? 'Gebruiker'}} kan <b>niet</b> inloggen
            @endif
        </dd>
    </dl>

    <h3 class="mt-8 text-xl font-semibold">Veto's</h3>
    @if($item->vetos->isEmpty())
        <i>{{$item->name ?? 'Gebruiker'}} heeft geen veto's.</i>
    @else
        <ul class="list-disc list-inside">
            @foreach($item->vetos as $veto)
                <li>{{$veto->task->name}}</li>
            @endforeach
        </ul>
    @endif
@endsection
