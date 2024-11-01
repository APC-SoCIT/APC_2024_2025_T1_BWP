
<h1>Forum</h1>

@foreach($posts as $post)
<div>
<h2><a href="{{ route('forum.show', $post->id) }}">{{ $post->title }}</a></h2>
<p>Posted by: {{ $post->user->username }}</p>
<p>{{ $post->content }}</p>
</div>
@endforeach

<a href="{{ route('forum.create') }}">Create a new post</a>

