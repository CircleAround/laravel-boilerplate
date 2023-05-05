<?php

namespace App\Http\Controllers\Manager;

use App\Models\Member;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $users = User::orderBy('id')->get();
        return view('manager.members.index', compact('team', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team)
    {
        $member = new Member($request->all());
        $member->team_id = $team->id;
        $member->save();

        return to_route('manager.teams.members.index', $team);
    }
}
