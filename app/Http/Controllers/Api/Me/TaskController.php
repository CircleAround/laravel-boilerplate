<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $tasks = $user
            ->assignedTasks()
            ->with('team', 'assignee')
            ->orderBy('id')
            ->get();

        return response()->json($tasks);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $task = $user
            ->assignedTasks()
            ->where('id', $id) // ここで teamを with で取ってくる実装もあり
            ->first();

        return response()->json($task->load('team')); // load の方法も知っていると良い
    }
}
