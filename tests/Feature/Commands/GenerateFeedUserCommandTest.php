<?php

namespace Tests\Feature\Command;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateFeedUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_feed_user_is_generated()
    {
        $this->withoutExceptionHandling();

        $feedUserId = config('feed.user_id');
        $feedUserName = config('feed.user_name');

        $this->artisan('feed:generate-user')->assertExitCode(0);

        $feedUser = User::find($feedUserId);

        $this->assertEquals($feedUser->id, $feedUserId);
        $this->assertEquals($feedUser->name, $feedUserName);
    }
}
