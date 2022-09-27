@extends('layouts.app')

@section('content')
    <div class="container-fluid panel__text-container">

        <h1 class="text-black panel__welcome-header">
            {{ $survey->title }}
        </h1>

        <h2>
            Opis ankiety: {{ $survey->description }}
        </h2>

        <form method="POST" enctype="multipart/form-data" action="/ankiety/{{ $survey->id }}" class="crud__form">
            @method('POST')
            @csrf

            @errorBox
            @enderrorBox

            <input type="hidden" name="survey_id" id="survey_id" value="{{ $survey->id }}"
                autocomplete="off" required>

            @foreach($survey->questions as $index => $question)
                <div class="card mt-4">
                    <div class="card-header">
                        <strong>
                            Pytanie {{ $index + 1 }}.
                        </strong>
                    </div>

                    <div class="card-body">

                        <div class="crud__attribute-wrapper">

                            @if ($question->is_open_question)
                                <label for="{{ $question->id }}content" class="form-label crud__label">
                                    {{ $question->title }}
                                </label>
                            
                                <textarea name="{{ $question->id }}content" id="{{ $question->id }}content" rows="3"
                                class="form-control crud__text-area @error('{{ $question->id }}content') is-invalid crud__text-area--invalid @enderror"
                                required>{{ old($question->id . 'content') }}</textarea>
                            
                                @error('{{ question->id }}content')
                                <span class="invalid-feedback crud__error">
                                Error: {{ $message }}
                                </span>
                            @enderror

                            @else

                                <p class="form-label crud__label">
                                    {{ $question->title }}
                                </p>
                            
                                <div class="crud__radio-option-wrapper">
                                <input type="radio" id="{{ $question->id }}content-yes" name="{{ $question->id }}content" value="true" checked
                                    class="form-check-input crud__radio-input @error('{{ $question->id }}content-yes') is-invalid @enderror">
                            
                                <label for="{{ $question->id }}content-yes" class="form-check-label crud__label crud__label--radio">
                                    tak
                                </label>
                                </div>
                            
                                <div class="crud__radio-option-wrapper">
                                <input type="radio" id="{{ $question->id }}content-no" name="{{ $question->id }}content" value="false"
                                    class="form-check-input crud__radio-input @error('{{ $question->id }}content-no') is-invalid @enderror">
                            
                                <label for="{{ $question->id }}content-no" class="form-check-label crud__label crud__label--radio">
                                    nie
                                </label>
                                </div>
                            
                                @error('{{ $question->id }}content')
                                <span class="invalid-feedback crud__error">
                                Error: {{ $message }}
                                </span>
                                @enderror
                            @endif
                        </div>
                        {{-- <ul class="list-group">
                            @foreach($question->answers as $answer)
                                <label for="answer{{ $answer->id }}">
                                    <li class="list-group-item">
                                        <input type="radio" name="responses[{{ $index }}][answer_id]" id="answer{{ $answer->id }}"
                                               {{ (old('responses.' . $index . '.answer_id') == $answer->id) ? 'checked' : '' }}
                                               class="mr-2" value="{{ $answer->id }}">
                                        {{ $answer->answer }}

                                        <input type="hidden" name="responses[{{ $index }}][question_id]" value="{{ $question->id }}">
                                    </li>
                                </label>
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
            @endforeach
            
            <button type="submit" class="button button__submit button__submit--create">
                Wyślij wypełnioną ankietę
            </button>
        </form>









        {{-- <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="post">
            @csrf

            @foreach($questionnaire->questions as $key => $question)
                <div class="card mt-4">
                    <div class="card-header"><strong>{{ $key + 1 }}</strong> {{ $question->question }}</div>

                    <div class="card-body">

                        @error('responses.' . $key . '.answer_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                                <label for="answer{{ $answer->id }}">
                                    <li class="list-group-item">
                                        <input type="radio" name="responses[{{ $key }}][answer_id]" id="answer{{ $answer->id }}"
                                               {{ (old('responses.' . $key . '.answer_id') == $answer->id) ? 'checked' : '' }}
                                               class="mr-2" value="{{ $answer->id }}">
                                        {{ $answer->answer }}

                                        <input type="hidden" name="responses[{{ $key }}][question_id]" value="{{ $question->id }}">
                                    </li>
                                </label>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <div class="card mt-4">
                <div class="card-header">Your Information</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input name="survey[name]" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter Name">
                        <small id="nameHelp" class="form-text text-muted">Hello! What's your name?</small>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input name="survey[email]" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                        <small id="emailHelp" class="form-text text-muted">Your Email Please!</small>

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <button class="btn btn-dark" type="submit">Complete Survey</button>
                    </div>
                </div>
            </div>
        </form> --}}






        <hr>

        <a href="{{ route('home.index') }}" class="panel__important-link">Wróć do panelu</a>

    </div>
@endsection
