<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_response_of_specify_task()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);

        $task = Task::factory()->create(['team_id' => $team->id, 'assignee_id' => $user->id]);
        $team = $task->team;
        $taskObj = $task->toArray();
        $this->assertEquals($team->toArray(), $taskObj['team']); // taskObj には team が含まれている

        Sanctum::actingAs($user);

        $response = $this->get('/api/tasks/' . $task->id);
        $response->assertStatus(200)->assertJson($taskObj);
    }
}
