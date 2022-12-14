@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Zalogowano jako 
            <img src="{{ Storage::url($user->image_path) }}" class="panel__user-image" alt="user image">
                <b>{{ $user->name }} {{ $user->surname }}</b>
            o id: <b>{{ $user->id }}</b>
        </h1>

        <h2 class="panel__role-header">
            Twoja rola to: <b>{{ $user->getRoleNames()[0] }}</b>
        </h2>

        <h2>
            <a href="{{ route('user.edit_account') }}">
                Edytuj dane swojego konta
            </a>
        </h2>

        <h2>
            <a href="{{ route('survey.create') }}">
                Stwórz nową ankietę
            </a>
        </h2>

        <h2>
            <a href="{{ route('survey.index_user_surveys') }}">
                Wyświetl listę twoich ankiet
            </a>
        </h2>

        <h2>
            <a href="{{ route('survey.index') }}">
                Wyświetl listę ankiet wszystkich użytkowników
            </a>
        </h2>
        
        @if (Auth::user()->hasRole('admin'))
        <h2>
            <a href="{{ route('user.index') }}">
                Wyświetl listę użytkowników serwisu
            </a>
        </h2>
        @endif

    </div>
@endsection
