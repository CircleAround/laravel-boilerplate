<?php

namespace App\Http\Controllers\Manager;

use App\Http\Requests\TeamModifyRequest;
use App\Models\Team;
use Illuminate\Http\Request;

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
        return view('manager.teams.show', compact('team'));
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
    public function update(TeamModifyRequest $request, Team $team)
    {
        // @see https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
        $validated = $request->validated();

        $team->fill($validated);
        $team->save();

        return to_route('manager.teams.show', ['team' => $team->id])->with('success', "{$team->name}を更新しました");
    }
}
