@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->body }}</p>
                <hr>
                <h4>Comments</h4>
                @foreach($post->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-body">
                            {{ $comment->body }}
                            <br>
                            <small>By {{ $comment->user->name }}</small>
                        </div>
                    </div>
                @endforeach
                @auth
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="body">Add Comment</label>
                            <textarea name="body" id="body" class="form-control" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
@endsection
