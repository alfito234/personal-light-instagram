<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(string $id): Response
    {
        $user = User::with([
            'profile',
            'posts' => function ($query) {
                $query->latest();
            }
        ])->findOrFail($id);

        return Inertia::render('Profile/Index', [
            'user' => $user
        ]);
    }

    public function edit(User $user): Response
    {
        $user->load('profile');

        return Inertia::render('Profile/Edit', [
            'user' => $user
        ]);
    }


    public function update(Request $request, User $user)
    {

        $data = $request->validate([
            'description' => ['nullable', 'string'],
            'url' => ['nullable', 'url'],
            'profile_picture' => ''
        ]);

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile', 'public');
            $data['profile_picture'] = $imagePath;
        }

        auth()->user()->profile->update($data);

        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully!');
    }
}
