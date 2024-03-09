<?php

namespace Tests\Feature\Api\Me;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Team;

class TeamTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_response_of_user_assinged_tasks()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);
        $team2 = Team::factory()->create(['owner_id' => $other->id]);
        $team3 = Team::factory()->create(['owner_id' => $other->id]);

        $team->members()->create(['user_id' => $user->id]);
        $team->members()->create(['user_id' => $other->id]);
        $team2->members()->create(['user_id' => $other->id]); // $userが含まれないチームなので無視される
        $team3->members()->create(['user_id' => $user->id, 'role' => 1]);

        Sanctum::actingAs($user);

        $response = $this->get('/api/me/teams');

        $json = $response->assertStatus(200)->decodeResponseJson();
        $this->assertEquals([...$team->toArray(), 'role' => 0], $json[0]); // レスポンスにTeam情報と共にroleが含まれている
        $this->assertEquals([...$team3->toArray(), 'role' => 1], $json[1]);
    }
}
