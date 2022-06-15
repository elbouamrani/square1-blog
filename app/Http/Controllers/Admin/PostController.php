<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $authorId = auth()->user()->id;
        $posts = Post::where('author_id', $authorId)->paginate(10);

        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(PostRequest $request)
    {
        $author = auth()->user();

        $post = Post::make([
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
            'publication_date'  => $request->input('publication_date'),
        ]);

        $author->posts()->save($post);

        return redirect()->route('posts.index');
    }
}
