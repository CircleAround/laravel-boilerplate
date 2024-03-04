<?php

namespace App\Http\Controllers\Api\Me;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            ->orderBy('id')
            ->get();

        return response()->json($tasks);
    }
}
