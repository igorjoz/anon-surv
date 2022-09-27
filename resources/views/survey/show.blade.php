@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <div class="crud__info-wrapper">
            <h1 class="text-black panel__welcome-header">
                Ankieta "{{ $survey->title }}"
            </h1>

            @if (Auth::user()->hasRole('admin'))
                <a href="{{ route('survey.edit', $survey->id) }}" class="crud__button">
                    Edytuj
                </a>
    
                <form method="post" action="{{ route('survey.destroy', $survey->id) }}">
                    @method('DELETE')
                    @csrf
                    
                    <button class="button button__submit button__submit--delete">
                        Usuń
                    </button>
                </form>
            @endif
        </div>
        
        <h2>
            Opis ankiety: {{ $survey->description }}
        </h2>
                
        <h2>
            Ilość pytań w ankiecie: {{ $questions->count() }}
        </h2>
        
        <h2>Pytania [otwarte lub tak/nie]:</h2>
        <ol>
            @foreach($questions as $question)
                <li>
                    {{ $question->title }}
                    @if ($question->is_open_question)
                        [otwarte]
                    @else
                        [tak/nie]
                    @endif
                </li>
            @endforeach
        </ol>

        <a href="{{ route('question.create') }}">Dodaj kolejne pytanie</a>
        <a href="{{ route('home.index') }}">Przejdź do panelu</a>

    </div>
@endsection
