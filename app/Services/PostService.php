<?php

namespace App\Services;

use Illuminate\Support\Str;

use App\Models\Post;

class PostService
{
    public function generateUniqueSlug(String $title)
    {
        do {
            $suffix = Str::random(8);
            $slug = Str::slug($title . '-' . $suffix);

            $unique = Post::where('slug', $slug)->exists();
        } while ($unique);

        return $slug;
    }
}