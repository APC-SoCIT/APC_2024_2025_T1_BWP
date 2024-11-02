@extends('layouts.dashboard-layout')
@section('content')
    <h1>{{ $post->title }}</h1>
    <p>Posted by: {{ $post->user->username }}</p>
    <p>{{ $post->content }}</p>

    <h3>Replies:</h3>
    @foreach($post->replies as $reply)
        <div>
            <p><strong>{{ $reply->user->username }}:</strong> {{ $reply->content }}</p>
        </div>
    @endforeach

    <h3>Add a Reply:</h3>
    <form action="{{ route('forum.reply', $post->id) }}" method="POST">
        @csrf
        <div>
            <label for="content">Reply:</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        <button type="submit">Submit Reply</button>
    </form>
@endsection