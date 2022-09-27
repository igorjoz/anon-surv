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
            <a href="{{ URL::to('/ankiety/' . $survey->id . "-" . $survey->url_slug) }}">
                {{ URL::to('/ankiety/' . $survey->id . "-" . $survey->url_slug) }}
            </a>
        </h2>

        <h2>
            Czy ankieta jest widoczna dla użytkowników: {{ $survey->is_published ? "tak" : "nie" }}
        </h2>
                
        <h2>
            Ilość pytań w ankiecie: {{ $questions->count() }}
        </h2>
        
        {{-- @if (count($questions)) --}}

        <h2>Lista pytań (otwarte lub zamknięte typu tak/nie)</h2>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">@sortablelink('id', 'ID')</th>
                    <th scope="col" class="table__header">@sortablelink('title', 'Treść pytania')</th>
                    <th scope="col" class="table__header">Typ pytania</th>
                    <th scope="col" class="table__header">Ilość wszystkich odpowiedzi</th>
                    <th scope="col" class="table__header">Procent odpowiedzi "tak" (jeśli dotyczy)</th>
                    <th scope="col" class="table__header">Procent odpowiedzi "nie" (jeśli dotyczy)</th>
                    <th scope="col" class="table__header">@sortablelink('created_at', 'Data stworzenia')</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($questions as $question)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $question->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        {{ $question->title }}
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $question->is_open_question ? "otwarte" : "tak/nie" }}
                    </td>

                    <td class="table__cell">
                        {{ $survey->completedSurveys->count() }}
                    </td>

                    <td class="table__cell">
                        @if ($question->is_yes_no_question)
                        {{ $question->answers->where('is_affirmative', '=', true)->count() / $survey->completedSurveys->count() * 100 }}%
                        @else
                        -
                        @endif
                    </td>

                    <td class="table__cell">
                        @if ($question->is_yes_no_question)
                        {{ $question->answers->where('is_affirmative', '=', false)->count() / $survey->completedSurveys->count() * 100 }}%
                        @else
                        -
                        @endif
                    </td>
    
                    <td class="table__cell">
                        {{ $survey->created_at->format('Y-m-d') }}
                    </td>
    
                    <td class="table__cell">
                        <div class="table__actions-wrapper">
                            <a href="{{ route('question.edit', $question->id) }}">
                            Edytuj
                            </a>

                            <form method="post" action="{{ route('question.destroy', $question->id) }}">
                                @method('DELETE')
                                @csrf
                                
                                <button class="button button__submit button__submit--delete button__submit--small">
                                    Usuń
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        {{-- @else
            <h2>Brak dodanych pytań</h2>
        @endif --}}

        @if (count($questions))
            <a href="{{ route('question.create', ['surveyId' => $survey->id]) }}" class="panel__important-link">Dodaj kolejne pytanie</a>
        @else
            <a href="{{ route('question.create', ['surveyId' => $survey->id]) }}" class="panel__important-link">Dodaj pytania</a>
        @endif
        
        <a href="{{ route('home.index') }}" class="panel__important-link">Przejdź do panelu</a>

    </div>
@endsection
