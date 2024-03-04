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
     * @return void
     */
    public function test_createWithOwner_store_team_and_member()
    {
        $team_count = Team::count();
        $member_count = Member::count();

        $user = User::factory()->create();
        $team = Team::createWithOwner($user, ['name' => 'test']);

        $this->assertEquals($team->owner_id, $user->id);
        $this->assertEquals($team->members()->first()->id, $user->id);
        $this->assertEquals($team_count + 1, Team::count());
        $this->assertEquals($member_count + 1, Member::count());
    }

    /**
     * @return void
     */
    public function test_isManager_check_manager_role()
    {
        $user = User::factory()->create();
        $team = Team::createWithOwner($user, ['name' => 'test']);

        $this->assertTrue($team->isManager($user)); // owner は manager であり、真

        $user2 = User::factory()->create();
        $team->members()->create(['user_id' => $user2->id, 'role' => 0]);

        $this->assertFalse($team->isManager($user2)); // 通常メンバーは manager ではないので、偽
    }
}
