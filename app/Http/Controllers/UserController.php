<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of all users (admin only).
     */
    public function index()
    {
        // Ensure the user is an admin
        if (auth()->user()->TypeCompte !== 'admin') {
            abort(403);
        }

        $users = Compte::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $matricule)
    {
        // Ensure the user is an admin
        if (auth()->user()->TypeCompte !== 'admin') {
            abort(403);
        }

        $user = Compte::findOrFail($matricule);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, string $matricule)
    {
        // Ensure the user is an admin
        if (auth()->user()->TypeCompte !== 'admin') {
            abort(403);
        }

        $user = Compte::findOrFail($matricule);

        $request->validate([
            'login' => 'required|string|unique:comptes,login,' . $user->Matricule . ',Matricule',
            'nom' => 'required|string',
            'Prenom' => 'required|string',
            'Email' => 'required|email|unique:comptes,Email,' . $user->Matricule . ',Matricule',
            'TypeCompte' => 'required|in:admin,personnel',
            'new_password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Update user data
        $user->login = $request->login;
        $user->nom = $request->nom;
        $user->Prenom = $request->Prenom;
        $user->Email = $request->Email;
        $user->TypeCompte = $request->TypeCompte;

        // Handle password change if requested
        if ($request->new_password) {
            $user->motdepasse = Hash::make($request->new_password);
        }

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(string $matricule)
    {
        // Ensure the user is an admin
        if (auth()->user()->TypeCompte !== 'admin') {
            abort(403);
        }

        $user = Compte::findOrFail($matricule);

        // Delete user's photo if exists
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // Delete the user's reservations first (because of foreign key constraints)
        $user->reservations()->delete();

        // Delete the user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
