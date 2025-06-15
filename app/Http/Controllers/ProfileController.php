<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar opsional
        ]);

        $user = Auth::user(); // auth()->user();

        // Simpan gambar profil jika diunggah
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $lokasiFile = 'profile_pictures/' . $user->id;
            Storage::disk('public')->putFileAs($lokasiFile, $file, 'profile_picture.jpg');
        }

        // Perbarui nama pengguna
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the authenticated user's password.
     */
    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:3', 'confirmed'], // 'confirmed' checks against password_confirmation
        ]);

        $user = $request->user(); // Get the currently authenticated user

        // 1. Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            // Throw a custom validation error for the current_password field
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('status', 'Password updated successfully!');
    }
}
