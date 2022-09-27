@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Dodawanie pytania do ankiety "{{ $survey->title }}"
        </h1>

        <form method="POST" enctype="multipart/form-data" action="{{ route('question.store') }}" class="crud__form">
            @method('POST')
            @csrf

            @errorBox
            @enderrorBox
        
            <input type="hidden" name="survey_id" id="survey_id" value="{{ $survey->id }}"
                autocomplete="off" required>

            <div class="crud__attribute-wrapper">
                <label for="title" class="form-label crud__label">
                    Treść pytania
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
                <label for="question_type" class="form-label crud__label crud__label--close">
                  Wybierz typ pytania
                </label>
              
                <select name="question_type" id="question_type"
                  class="form-select crud__select @error('question_type') is-invalid crud__select--invalid @enderror">
                  <option value="open">
                    Otwarte
                  </option>
              
                  <option value="yes-no">
                    Tak/Nie
                  </option>
                </select>
              
                @error('question_type')
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
