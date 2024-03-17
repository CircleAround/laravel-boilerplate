<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        $comments = $task->comments()->with('author')->orderBy('id')->get();
        return response()->json($comments->toArray());
    }

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
        return response()->json(['status' => 'success']);
    }
}
