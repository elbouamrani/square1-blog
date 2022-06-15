<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class FeedImportCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_feed_import_command()
    {
        Config::set('feed.endpoint', 'https://feed.com/posts');
        Config::set('feed.user_id', 1);

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
