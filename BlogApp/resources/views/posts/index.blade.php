@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Blog App</h1>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        @if($post->image_url)
                            <img src="{{ asset('storage/' . $post->image_url) }}" class="card-img-top" alt="{{ $post->title }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->body, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
