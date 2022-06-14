<?php

namespace App\Http\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function home()
    {
        $posts = Post::query()->paginate(15);

        return view('blog.home', ['posts' => $posts]);
    }

    public function post(Post $post)
    {
        return view('blog.post', ['post' => $post]);
    }
}
