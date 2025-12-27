<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('warga.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'photo' => 'nullable|image|max:2048',
        ]);

        // Update foto profil (Jetstream)
        if ($request->hasFile('photo')) {
            $user->updateProfilePhoto($request->file('photo'));
        }

        // Update data lainnya
        $user->update([
            'name' => $request->name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        // 👉 Redirect ke dashboard warga
        return redirect()
            ->route('warga.dashboard')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
