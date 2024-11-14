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
        $request->validate([
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'profile_picture' => 'nullable|image'
        ]);

        $profileData = $request->only('description', 'url');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile->profile_picture) {
                Storage::disk('public')->delete($user->profile->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profiles', 'public');
            $profileData['profile_picture'] = $path;
        }

        $user->profile->update($profileData);

        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully.');
    }
}
