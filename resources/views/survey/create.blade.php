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
                  Opis ankiety
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

            <div class="crud__attribute-wrapper">
                <p class="crud__label crud__label--close">
                  <span>
                    Czy ankieta ma być już dostępna dla użytkowników?
                  </span>
                </p>
              
                <div class="crud__radio-option-wrapper">
                  <input type="radio" id="is_published-yes" name="is_published" value="true" checked
                    class="form-check-input crud__radio-input @error('is_published-yes') is-invalid @enderror">
              
                  <label for="is_published-yes" class="form-check-label crud__label crud__label--radio">
                    tak
                  </label>
                </div>
              
                <div class="crud__radio-option-wrapper">
                  <input type="radio" id="is_published-no" name="is_published" value="false"
                    class="form-check-input crud__radio-input @error('is_published-no') is-invalid @enderror">
              
                  <label for="is_published-no" class="form-check-label crud__label crud__label--radio">
                    nie
                  </label>
                </div>
              
                @error('is_published')
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

        <a href="{{ route('home.index') }}" class="panel__important-link">Wróć do panelu</a>

    </div>
@endsection
