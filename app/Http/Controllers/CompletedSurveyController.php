<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\CompletedSurvey;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompletedSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create($id, $slug)
    {
        $survey = Survey::findOrFail($id);

        return view('completed-survey.create', [
            'survey' => $survey
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $survey = Survey::findOrFail($request->survey_id);
        $questions = $survey->questions;
        $validated = $request->validate([
            'survey_id' => 'required',
        ]);

        $completedSurvey = CompletedSurvey::create([
            'survey_id' => $survey->id,
            'user_id' => $userId,
        ]);

        foreach ($questions as $question) {
            $answerContent = request($question->id . 'content');

            if ($question->is_open_question) {
                Answer::create([
                    'content' => $answerContent,
                    'completed_survey_id' => $completedSurvey->id,
                    'question_id' => $question->id,
                ]);
            } else {
                Answer::create([
                    'is_affirmative' => $answerContent === "true",
                    'completed_survey_id' => $completedSurvey->id,
                    'question_id' => $question->id,
                ]);
            }
        }

        return view('home.index', [
            'user' => Auth::user(),
        ])
            ->with('flashMessage', 'Pomyślnie wypełniono ankietę "' . $survey->title . '"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompletedSurvey  $completedSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompletedSurvey $completedSurvey)
    {
        //
    }
}
