<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertQuestionRequest;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surveyId = request()->query()['surveyId'];
        $survey = Survey::findOrFail($surveyId);

        return view('question.create', [
            'survey' => $survey
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertQuestionRequest $request)
    {
        // $this->authorize('store', $question);

        $survey = Survey::findOrFail($request->survey_id);
        $validated = $request->validated();

        if ($request->question_type == 'open') {
            $validated['is_open_question'] = true;
            $validated['is_yes_no_question'] = false;
        } else {
            $validated['is_open_question'] = false;
            $validated['is_yes_no_question'] = true;
        }
        $validated['survey_id'] = $survey->id;

        $question = Question::create($validated);

        return view('survey.show', [
            'survey' => $survey,
            'questions' => $survey->questions,
        ])->with('flashMessage', 'Stworzono pytanie "' . $question->title . '"');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
