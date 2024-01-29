

@extends('layout')

@section('title', 'Laravel')

@section('content')

    @foreach($comments as $comment)
        <div class="card w-75 mb-3">
        <h5 class="card-header">{{ $comment->name }}</h5>
            <div class="card-body">
                <p class="card-text">{{ $comment->content }}</p>

                <a href="{{auth() ? route('comment.create', ['comment' => $comment->id]) : route('login')}}" class="btn btn-dark">Reply</a>
            </div>
        </div>
    @endforeach

@endsection
