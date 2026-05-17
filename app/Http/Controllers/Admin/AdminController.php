<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'total_users'   => User::count(),
            'admins'        => User::role('admin')->count(),
            'regular_users' => User::role('user')->count(),
        ];

        $recentActivities = Activity::with('causer')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }

    public function users(): View
    {
        $users = User::with('roles')->latest()->paginate(20);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', "unique:users,email,{$user->id}"],
        ]);

        $user->update($validated);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("Ažurirani podaci korisnika {$user->name}");

        return back()->with('success', "Podaci korisnika {$user->name} uspješno ažurirani.");
    }

    public function assignRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user->syncRoles([$request->role]);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->log("Dodijelena uloga '{$request->role}' korisniku {$user->name}");

        return back()->with('success', "Uloga za korisnika {$user->name} uspješno ažurirana.");
    }
}
