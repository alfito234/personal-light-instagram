<?php

namespace App\Http\Controllers;

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
            'profile_picture' => ['image', 'max:10240']
        ]);

        if ($request->hasFile('profile_picture')) {
            // Simpan gambar
            $imagePath = $request->file('profile_picture')->store('profile', 'public');
        }

        dd($data);

        // Update profil dengan data baru
        auth()->user()->profile->update(array_merge($data, [
            'profile_picture' => $imagePath ? $imagePath : auth()->user()->profile->profile_picture, // Hanya update jika ada gambar
        ]));



        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully!');
    }
}
