@extends('layouts.blog')

@section('content')
<section class="text-gray-600 body-font overflow-hidden flex-grow">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container divide-y-2 divide-gray-100 w-full md:max-w-4xl mx-auto">
            @foreach($posts as $post)
            <div class="block p-6 bg-white rounded-lg border border-gray-200 mb-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a href="{{ route('blog.post', ['post' => $post]) }}">{{ $post->title }}</a>
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                    Written by : <b>{{ $post->author->name }}</b>
                </p>
                <p class="font-normal text-gray-700 dark:text-gray-400">
                    published at : <b>{{ $post->publication_date }}</b>
                </p>
            </div>
            @endforeach
        </div>
        <div class="container md:max-w-4xl mx-auto">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection