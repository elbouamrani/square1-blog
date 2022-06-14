<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    private PostService $postService; 

    function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function creating(Post $post)
    {
        $post->slug = $this->postService->generateUniqueSlug($post->title);
    }
}
