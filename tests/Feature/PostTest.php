<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_post_slug_is_generated()
    {
        $user = User::factory()->create();
        $post = $user->posts()->save(Post::factory()->make());

        $this->assertNotNull($post->slug);
    }

    public function test_post_slug_is_unique()
    {
        $postTitle = $this->faker->sentence();

        $user = User::factory()->create();

        $post1 = $user->posts()->save(Post::factory()->make(
            ['title' => $postTitle],
        ));

        $post2 = $user->posts()->save(Post::factory()->make(
            ['title' => $postTitle],
        ));

        $this->assertNotEquals($post1->slug, $post2);
    }

    public function test_post_index_can_be_rendered()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('posts.create'));

        $response->assertStatus(200);
    }

    public function test_post_create_form_can_be_rendered()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('posts.create'));

        $response->assertStatus(200);
    }

    public function test_user_can_create_a_post()
    {
        $user = User::factory()->create();

        $post = Post::factory()->make();

        $this->actingAs($user);

        $response = $this->post(route('posts.store'), $post->toArray());

        $response->assertSessionHasNoErrors();

        $dbPost = Post::where('title', $post->title)->first();

        $this->assertNotNull($dbPost);

        $response->assertRedirect(route('posts.index'));
    }

    public function test_when_user_create_a_post_is_stored()
    {
        $user = User::factory()->create();

        $post = Post::factory()->make();

        $this->actingAs($user);

        $this->post(route('posts.store'), $post->toArray());

        $dbPost = Post::where('title', $post->title)->first();

        $this->assertNotNull($dbPost);
    }
}
