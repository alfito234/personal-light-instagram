<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostsController extends Controller
{

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => ['required'],
            'image' => ['required', 'image', 'max:10240']
        ]);

        $path = request('image')->store('uploads', 'public');

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $path
        ]);

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $user = $post->user;
        return Inertia::render('Posts/DetailPost', ['user' => $user, 'post' => $post]);

    }
}
