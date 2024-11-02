@extends('layouts.dashboard-layout') <!-- Extend your dashboard layout -->

@section('content')
    <h1>Create a New Post</h1>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('forum.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea name="content" id="content" required></textarea>
        </div>
        <button type="submit">Create Post</button>
    </form>
@endsection