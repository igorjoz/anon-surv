@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Tworzenie nowej ankiety
        </h1>

        <form method="POST" enctype="multipart/form-data" action="{{ route('survey.store') }}" class="crud__form">
            @method('POST')
            @csrf

            @errorBox
            @enderrorBox
        
            <div class="crud__attribute-wrapper">
                <label for="title" class="form-label crud__label">
                    Tytuł ankiety
                </label>
            
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                autocomplete="off" class="form-control crud__input @error('title') is-invalid crud__input--invalid @enderror"
                required>
            
                @error('title')
                <span class="invalid-feedback crud__error">
                Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="url_slug" class="form-label crud__label">
                    URL slug
                </label>
            
                <input type="text" name="url_slug" id="url_slug" value="{{ old('url_slug') }}"
                autocomplete="off" class="form-control crud__input @error('url_slug') is-invalid crud__input--invalid @enderror"
                required>
            
                @error('url_slug')
                <span class="invalid-feedback crud__error">
                Error: {{ $message }}
                </span>
                @enderror
            </div>

            <div class="crud__attribute-wrapper">
                <label for="description" class="form-label crud__label">
                  Podtytuł / opis ankiety
                </label>
              
                <textarea name="description" id="description" rows="3"
                  class="form-control crud__text-area @error('description') is-invalid crud__text-area--invalid @enderror"
                  required>{{ old('description') }}</textarea>
              
                @error('description')
                <span class="invalid-feedback crud__error">
                  Error: {{ $message }}
                </span>
                @enderror
            </div>
            
            <button type="submit" class="button button__submit button__submit--create">
                Stwórz nową ankietę
            </button>
        </form>

        <hr>

        <a href="{{ route('home.index') }}">Wróć do panelu</a>

    </div>
@endsection
