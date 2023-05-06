<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends \App\Http\Controllers\Controller
{
    public function show(Task $task)
    {
        $comments = $task->comments()->orderBy('created_at')->get();
        return view('tasks.show', compact('task', 'comments'));
    }
}
