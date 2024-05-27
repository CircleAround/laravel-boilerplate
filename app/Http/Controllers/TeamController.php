<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamModifyRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = new Team();
        return view('teams.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamModifyRequest $request)
    {
        $validated = $request->validated();
        $team = Team::createWithOwner(Auth::user(), $validated);
        return to_route('manager.teams.show', $team)->with('success', 'チームを作成しました');
    }
}
