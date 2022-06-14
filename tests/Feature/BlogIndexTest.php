<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_a_list_of_blog_posts()
    {
        $response = $this->get(route('blog.home'));
        $response->assertStatus(200);
    }

    public function test_posts_are_shown_on_blog_index()
    {
        $user = User::factory()->create();
        $post = $user->posts()->save(Post::factory()->make());

        $response = $this->get(route('blog.home'));
        
        $response->assertSee($post->title);
    }
}
