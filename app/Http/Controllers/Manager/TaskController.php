<?php

namespace App\Http\Controllers\Manager;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;

class TaskController extends \App\Http\Controllers\Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        $task = new Task();
        return view('manager.tasks.create', compact('task', 'team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'assignee_id' => 'nullable'
        ]);

        $task = new Task($validated);
        $task->team_id = $team->id;
        $task->save();

        return to_route('manager.teams.show', $team)->with('success', 'タスクを作成しました');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Task $task)
    {
        return view('manager.tasks.edit', compact('team', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'assignee_id' => 'nullable'
        ]);

        $task->fill($validated);
        $task->save();

        return to_route('manager.teams.show', ['team' => $team->id])->with('success', "{$task->title}を更新しました");
    }
}
