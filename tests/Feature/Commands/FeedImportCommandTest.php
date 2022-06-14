<?php

namespace Tests\Feature\Command;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FeedImportCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_feed_import_command()
    {
        $this->withoutExceptionHandling();

        $endpoint = config('feed.endpoint');
        $feedMockPosts = Post::factory(3)->make()->toArray();

        Http::fake([
            $endpoint => Http::response([
                'data' => $feedMockPosts,
                'mock' => true,
            ]),
        ]);

        $this->artisan('feed:generate-user')->assertExitCode(0);

        $this->artisan('feed:import')->assertExitCode(0);

        $this->assertEquals(Post::query()->count(), count($feedMockPosts));
    }
}