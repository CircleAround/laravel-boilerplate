<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Task $task)
    {
        $validated = $request->validate([
            'message' => 'required|max:50',
            'kind' => 'nullable',
        ]);

        $task->appendComment(Auth::user(), $validated);

        return to_route('tasks.show', $task)->with('success', 'コメントしました');
    }
}
