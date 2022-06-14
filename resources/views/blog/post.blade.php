@extends('layouts.blog')

@section('title', $post->title . ' - ' . config('app.name'))

@push('meta')
    <meta name="author" content="{{ $post->author->name }}" />
@endpush

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grow">
    <div class="w-full px-4 md:px-6 text-xl text-gray-800 leading-normal" style="font-family:Georgia,serif;">
        <div class="font-sans">
            <h1 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-2 text-3xl md:text-4xl">{{ $post->title }}</h1>
            <p class="text-sm md:text-base font-normal text-gray-600">Published {{ $post->publication_date }} By {{ $post->author->name }}</p>
        </div>
        <p class="py-6">
            {{ $post->description }}
        </p>
    </div>
</div>
@endsection
