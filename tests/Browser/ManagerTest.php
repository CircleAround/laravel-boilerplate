<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Team;

class TaskTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testToTeamList(): void
    {
        $user = User::factory()->create();
        $team = Team::factory()->create(['name' => 'TestTeam', 'owner_id' => $user->id]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/')->assertSeeLink('チーム一覧');
            $browser->clickLink('チーム一覧');
            $browser->assertSeeLink('TestTeam');
        });

        $team->delete();
        $user->delete();
    }
}
