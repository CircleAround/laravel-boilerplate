<?php

namespace Tests\Feature\Api\Me;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_response_of_user_assinged_tasks()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);
        $team2 = Team::factory()->create(['owner_id' => $other->id]);

        $tasks = Task::factory()
            ->count(2)
            ->create(['team_id' => $team->id, 'assignee_id' => $user->id]);
        $tasks->push(Task::factory()->create(['team_id' => $team2->id, 'assignee_id' => $user->id]));
        Task::factory()->create(['team_id' => $team2->id, 'assignee_id' => $other->id]); // 担当者が違うので無視される

        Sanctum::actingAs($user);

        $response = $this->get('/api/me/tasks');
        $response->assertStatus(200)->assertJson($tasks->toArray());
    }

    public function test_returns_a_response_of_specify_task()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);

        $task = Task::factory()->create(['team_id' => $team->id, 'assignee_id' => $user->id]);

        Sanctum::actingAs($user);

        $response = $this->get('/api/me/tasks/' . $task->id);
        $response->assertStatus(200)->assertJson($task->toArray());
    }
}
