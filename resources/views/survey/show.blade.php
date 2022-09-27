@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <div class="crud__info-wrapper">
            <h1 class="text-black panel__welcome-header">
                Ankieta "{{ $survey->title }}" o id: {{ $survey->id }}
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
            Link do udostępnienia ankiety: 
            <a href="{{ $linkForUsers }}">
                {{ $linkForUsers }}
            </a>
        </h2>

        <h2>
            Czy ankieta jest widoczna dla użytkowników: {{ $survey->is_published ? "tak" : "nie" }}
        </h2>
                
        <h2>
            Ilość pytań w ankiecie: {{ $questions->count() }}
        </h2>
        
        @if (count($questions))
            <h2>Lista pytań (otwarte lub zamknięte typu tak/nie)</h2>
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
        @else
            <h2>Brak dodanych pytań</h2>
        @endif

        @if (count($questions))
            <a href="{{ route('question.create') }}" class="panel__important-link">Dodaj kolejne pytanie</a>
        @else
            <a href="{{ route('question.create') }}" class="panel__important-link">Dodaj pytania</a>
        @endif
        
        <a href="{{ route('home.index') }}" class="panel__important-link">Przejdź do panelu</a>

    </div>
@endsection
