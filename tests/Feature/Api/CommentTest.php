<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Team;
use App\Models\Task;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_a_response_of_task_comments()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);
        $task = Task::factory()->create(['team_id' => $team->id, 'assignee_id' => $user->id]);
        $comments = Comment::factory()
            ->count(3)
            ->create(['task_id' => $task->id, 'author_id' => $user->id]);

        Sanctum::actingAs($user);

        $response = $this->get("/api/tasks/{$task->id}/comments");
        $response->assertStatus(200)->assertJson($comments->toArray());
    }

    public function test_store_comment_success()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);
        $task = Task::factory()->create(['team_id' => $team->id, 'assignee_id' => $user->id]);
        $commentCount = Comment::count();

        Sanctum::actingAs($user);

        $response = $this->post("/api/tasks/{$task->id}/comments", [
            'message' => 'test message',
        ]);

        $json = $response->assertStatus(200)->decodeResponseJson();
        $this->assertEquals('success', $json['status']);
        $this->assertEquals($commentCount + 1, Comment::count());

        $last = Comment::latest()->first();
        $this->assertEquals('test message', $last->message);
        $this->assertEquals(0, $last->kind);
        $this->assertEquals($user->id, $last->author_id);
        $this->assertEquals($task->id, $last->task_id);
    }

    public function test_store_comment_finished()
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['owner_id' => $user->id]);
        $task = Task::factory()->create(['team_id' => $team->id, 'assignee_id' => $user->id]);
        $commentCount = Comment::count();

        Sanctum::actingAs($user);

        $response = $this->post("/api/tasks/{$task->id}/comments", [
            'message' => 'test message',
            'kind' => 1,
        ]);

        $json = $response->assertStatus(200)->decodeResponseJson();
        $this->assertEquals('success', $json['status']);
        $this->assertEquals($commentCount + 1, Comment::count());

        $last = Comment::latest()->first();
        $this->assertEquals('test message', $last->message);
        $this->assertEquals(1, $last->kind);
        $this->assertEquals($user->id, $last->author_id);
        $this->assertEquals($task->id, $last->task_id);
    }
}
