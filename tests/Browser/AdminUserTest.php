<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class AdminUserTest extends DuskTestCase
{
    public function testUser(): void
    {
        // 事前準備
        $admin = User::factory()->create(['role' => 1]);
        $user2 = User::factory()->create();

        $this->browse(function (Browser $browser) use ($admin, $user2) {
            $browser->loginAs($admin); // $adminのユーザーとしてログイン
            $browser->visit('/')->assertSeeLink('ユーザー管理'); // 「ユーザー管理」のリンクがあることのチェック

            $browser->clickLink('ユーザー管理'); // リンクをクリック
            $browser->assertSeeLink($user2->name); // $user2 の名前が表示されている
        });

        // 後始末
        $user2->delete();
        $admin->delete();
    }
}
