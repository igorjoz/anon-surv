@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Edycja konta użytkownika
            <img src="{{ Storage::url(Auth::user()->image_path) }}" class="panel__user-image" alt="User image">
            {{ $user->name }}, id: {{ $user->id }}
        </h1>

        @if (request()->route()->getName() == "user.edit_account")
        <form method="POST" enctype="multipart/form-data" action="{{ route('user.update_account') }}" class="crud__form">
        @else
        <form method="POST" enctype="multipart/form-data" action="/user/{{ $user->id }}" class="crud__form">
        @endif
            @method('PUT')
            @csrf
        
            <div class="crud__attribute-wrapper">
                <label for="name" class="form-label crud__label">
                    Nazwa użytkownika
                </label>
            
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                autocomplete="off" class="form-control crud__input @error('name') is-invalid crud__input--invalid @enderror"
                required>
            
                @error('name')
                <span class="invalid-feedback crud__error">
                Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="email" class="form-label crud__label">
                  E-mail
                </label>
              
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                  class="form-control crud__input @error('email') is-invalid crud__input--invalid @enderror" required>
              
                @error('email')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>
            
            <button type="submit" class="button button__submit button__submit--edit">
                Edytuj dane użytkownika
            </button>
        </form>

        <hr>

        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
