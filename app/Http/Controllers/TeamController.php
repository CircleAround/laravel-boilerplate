<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends \App\Http\Controllers\Controller
{
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
        ]);

        $team = DB::transaction(function () use ($validated) {
            $team = new Team($validated);
            $team->owner_id = Auth::user()->id;
            $team->save();

            $member = new Member();
            $member->team_id = $team->id;
            $member->user_id = $team->owner_id;
            $member->role = 1;
            $member->save();

            return $team;
        });

        return to_route('manager.teams.show', $team)->with('success', 'チームを作成しました');
    }
}
