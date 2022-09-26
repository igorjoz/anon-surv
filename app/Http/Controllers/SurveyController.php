<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Requests\UpsertSurveyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter = request()->query('filter');

        if (!empty($filter)) {
            $surveys = Survey::sortable()
                ->with('user')
                ->where('title', 'like', '%' . $filter . '%')
                ->orWhere('description', 'like', '%' . $filter . '%');
        } else {
            $surveys = Survey::with('user')
                ->sortable();
        }

        return view('survey.index', [
            'surveys' => $surveys->paginate(10),
            'filter' => $filter,
        ]);
    }

    /**
     * Display a listing of surveys belonging to the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserSurveys()
    {
        $filter = request()->query('filter');
        $user = Auth::user();

        $surveys = Survey::sortable()
            ->where('user_id', '=', $user->id);

        if (!empty($filter)) {
            $surveys = $surveys->where('title', 'like', '%' . $filter . '%')
                ->orWhere('description', 'like', '%' . $filter . '%');
        }

        return view('survey.index-user-surveys', [
            'surveys' => $surveys->paginate(10),
            'filter' => $filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpsertSurveyRequest $request)
    {
        $userId = Auth::user()->id;
        $validated = $request->validated();
        $validated['user_id'] = $userId;

        $survey = Survey::create($validated);

        return redirect()->route('survey.index_user_surveys')
            ->with('flashMessage', 'Stworzono ankietę "' . $survey->name . '"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
