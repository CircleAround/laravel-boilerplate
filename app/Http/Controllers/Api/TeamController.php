<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $team = Team::createWithOwner(Auth::user(), $validated);

        return response()->json($team);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return response()->json($team);
    }

    public function summary(Team $team)
    {
        $latest_commented_task = $team->latestCommentedTask();
        $task_summary = $team->taskSummary();
        return response()->json([
            'latest_commented_task' => $latest_commented_task,
            'task_summary' => $task_summary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $team->fill($validated);
        $team->save();

        return response()->json($team);
    }
}
