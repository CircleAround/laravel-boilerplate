<?php

namespace App\Http\Controllers\Manager;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends \App\Http\Controllers\Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $tasks = $team->tasks()->with('assignee')->get();
        return view('manager.teams.show', compact('team', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('manager.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        // @see https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
        $validated = $request->validate([
            'name' => 'required|max:20'
        ]);

        $team->fill($validated);
        $team->save();

        return to_route('manager.teams.show', ['team' => $team->id])->with('success', "{$team->name}を更新しました");
    }
}
