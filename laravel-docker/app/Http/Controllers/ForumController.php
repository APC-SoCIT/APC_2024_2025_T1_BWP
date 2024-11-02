<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost; // Assuming you have a model for forum posts
use App\Models\ForumReply; // Include the ForumReply model
use Auth;

class ForumController extends Controller
{
    public function index()
    {
        // Fetch all forum posts
        $posts = ForumPost::with('user', 'replies.user')->get(); // Eager load users and replies
        return view('forum.index', compact('posts'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new forum post
        ForumPost::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('forum.index')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = ForumPost::with('user', 'replies.user')->findOrFail($id); // Load user and replies with the post
        return view('forum.show', compact('post'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500', // Adjust max length as needed
        ]);

        // Create a new reply
        ForumReply::create([
            'content' => $request->content,
            'forum_post_id' => $id,
            'user_id' => Auth::id(), // Set the user_id from the authenticated user
        ]);

        return redirect()->route('forum.show', $id)->with('success', 'Reply added successfully!');
    }
}