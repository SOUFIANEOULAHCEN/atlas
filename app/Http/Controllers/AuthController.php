<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'motdepasse' => 'required|string',
        ]);

        // Attempt authentication
        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['motdepasse']])) {
            $request->session()->regenerate();

            // Redirect based on TypeCompte
            return Auth::user()->TypeCompte === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'login' => 'Invalid credentials.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Matricule' => 'required|string|unique:comptes',
            'login' => 'required|string|unique:comptes',
            'motdepasse' => 'required|string|min:8|confirmed',
            'nom' => 'required|string',
            'Prenom' => 'required|string',
            'Email' => 'required|email|unique:comptes',
            'TypeCompte' => 'required|in:admin,personnel'
        ]);

        Compte::create([
            'Matricule' => $request->Matricule,
            'login' => $request->login,
            'motdepasse' => Hash::make($request->motdepasse),
            'nom' => $request->nom,
            'Prenom' => $request->Prenom,
            'Email' => $request->Email,
            'TypeCompte' => $request->TypeCompte,
            'photo' => $request->photo ?? null
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



    public function updateProfile(Request $request)
    {
        $user = Compte::find(Auth::id());

        $request->validate([
            'nom' => 'required|string',
            'Prenom' => 'required|string',
            'Email' => 'required|email|unique:comptes,Email,' . $user->Matricule . ',Matricule',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Verify current password if changing password
        if ($request->new_password && !Hash::check($request->current_password, $user->motdepasse)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update profile
        $user->nom = $request->nom;
        $user->Prenom = $request->Prenom;
        $user->Email = $request->Email;

        if ($request->new_password) {
            $user->motdepasse = Hash::make($request->new_password);
        }

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
    public function showProfile()
    {
        return view('profile.show');
    }

    public function editProfile()
    {
        return view('profile.edit');
    }
}
