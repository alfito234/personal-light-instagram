<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostsController extends Controller
{

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'caption' => ['required'],
            'image' => ['required', 'image', 'max:10240']
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $validatedData['caption'],
            'image' => $imagePath
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $user = $post->user;
        return Inertia::render('Posts/DetailPost', ['user' => $user, 'post' => $post]);
    }
}
