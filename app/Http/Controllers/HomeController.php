<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function show()
    {
        $posts = Post::with('user')->latest()->get();

        return Inertia::render('Home', ['posts' => $posts]);
    }
}
