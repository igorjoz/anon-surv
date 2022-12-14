@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            Lista wszystkich ankiet
        </h1>
        
        <form class="form-inline" method="GET">
            <div class="form-group mb-2">
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Nazwa ankiety" value="{{$filter}}">
            </div>
            <button type="submit" class="btn btn-default mb-2">Wyszukaj</button>
        </form>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="table__header">@sortablelink('id', 'ID')</th>
                    <th scope="col" class="table__header">@sortablelink('title', 'Tytuł')</th>
                    <th scope="col" class="table__header">Link do ankiety</th>
                    <th scope="col" class="table__header">@sortablelink('description', 'Opis')</th>
                    <th scope="col" class="table__header">@sortablelink('is_published', 'Czy opublikowana')</th>
                    <th scope="col" class="table__header">Ilość pytań</th>
                    <th scope="col" class="table__header">Ilość odesłanych ankiet</th>
                    <th scope="col" class="table__header">@sortablelink('created_at', 'Data stworzenia')</th>
                    <th scope="col" class="table__header">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @if ($surveys->count() == 0)
                <tr>
                    <td colspan="5">Brak ankiet do wyświetlenia</td>
                </tr>
                @endif

                @forelse ($surveys as $survey)
                @if ($survey->is_published)
                <tr>
                    <th scope="row" class="table__cell">
                        {{ $survey->id }}
                    </th>
    
                    <td class="table__cell table__cell--important">
                        <a href="{{ route('survey.show', $survey->id) }}">
                            {{ $survey->title }}
                        </a>
                    </td>

                    <td class="table__cell table__cell--important">
                        <a href="{{ URL::to('/ankiety/' . $survey->id . "-" . $survey->url_slug) }}">
                            {{ URL::to('/ankiety/' . $survey->id . "-" . $survey->url_slug) }}
                        </a>
                    </td>

                    <td class="table__cell table__cell--important">
                        {{ $survey->description }}
                    </td>

                    <td class="table__cell">
                        {{ $survey->is_published ? "tak" : "nie" }}
                    </td>

                    <td class="table__cell">
                        {{ $survey->questions->count() }}
                    </td>

                    <td class="table__cell">
                        {{ $survey->completedSurveys->count() }}
                    </td>
    
                    <td class="table__cell">
                        {{ $survey->created_at->format('Y-m-d') }}
                    </td>
    
                    <td class="table__cell">
                        <div class="table__actions-wrapper">
                            <a href="{{ route('survey.show', $survey->id) }}">
                                Podgląd ankiety i pytań, statystyki
                            </a>
                        </div>
                    </td>
                </tr>
                @endif
                @empty
                @endforelse
            </tbody>
        </table>

        {{ $surveys->withQueryString()->links() }}

    </div>
@endsection
