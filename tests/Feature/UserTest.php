<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_returns_a_successful_response_for_admin()
    {
        $this->seed('UserSeeder'); // UserSeeder を動かしてからテスト

        // id:1 は管理者で、管理者としてログインしている想定
        Sanctum::actingAs(User::first());

        // api/users へのアクセス
        // APIアクセスの場合にはヘッダをつける方が適切
        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/api/users');

        $response->assertStatus(200); // 200 OK が返ってくることを確認
        $json = $response->decodeResponseJson(); // JSONの値を取り出す

        $this->assertEquals(3, count($json)); // Seederで入った3人分のデータが取得できている
    }

    public function test_users_returns_a_fobidden_response_for_user()
    {
        Sanctum::actingAs(User::factory()->create()); // 一般ユーザー

        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/api/users');
        $response->assertStatus(403);
    }

    public function test_user_returns_a_successful_response()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/api/user');
        $response->assertStatus(200)->assertJson($user->toArray());
    }

    public function test_user_returns_a_failure_response_on_not_logged_in()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->get('/api/user');
        $response->assertStatus(401);
    }
}
