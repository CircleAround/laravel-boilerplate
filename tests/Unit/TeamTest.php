<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Team;
use App\Models\User;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_createWithOwner_store_team_and_member()
    {
        $team_count = Team::count();
        $member_count = Member::count();

        $user = User::factory()->create();
        $team = Team::createWithOwner($user, ['name' => 'test']);

        $this->assertEquals($team_count + 1, Team::count());
        $this->assertEquals($member_count + 1, Member::count());
    }
}
