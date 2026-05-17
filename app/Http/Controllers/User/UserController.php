<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
    public function dashboard(): View
    {
        $user = auth()->user();

        $activities = Activity::causedBy($user)
            ->latest()
            ->limit(10)
            ->get();

        return view('user.dashboard', compact('user', 'activities'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', "unique:users,email,{$user->id}"],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        activity()->causedBy($user)->log('Ažurirao profil');

        return back()->with('success', 'Profil uspješno ažuriran.');
    }
}
