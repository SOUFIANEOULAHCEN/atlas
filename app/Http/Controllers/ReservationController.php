<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Ajouter le middleware admin pour les routes admin
        $this->middleware(function ($request, $next) {
            if (in_array($request->route()->getName(), ['admin.reservations', 'admin.reservations.destroy', 'statistics'])
                && Auth::user()->TypeCompte !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Les utilisateurs normaux ne voient que leurs réservations
        $reservations = Reservation::where('Matricule', Auth::user()->Matricule)
            ->orderBy('DateReservation', 'desc')
            ->get();

        return view('reservation.index', compact('reservations'));
    }

    // User: Show create form
    public function create()
    {
        return view('reservation.create');
    }

    // User: Store new reservation
    public function store(Request $request)
    {
        $request->validate([
            'DateReservation' => 'required|date',
        ]);

        try {
            $reservation = Reservation::create([
                'DateReservation' => $request->DateReservation,
                'Repas1' => $request->has('Repas1'),
                'Repas2' => $request->has('Repas2'),
                'Repas3' => $request->has('Repas3'),
                'Matricule' => Auth::user()->Matricule,
                'Annulation' => false
            ]);

            if($reservation) {
                return redirect()->route('reservations.index')
                    ->with('success', 'Réservation créée avec succès!');
            }
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erreur lors de la création de la réservation: ' . $e->getMessage()]);
        }

        return back()->withInput()
            ->withErrors(['error' => 'Erreur lors de la création de la réservation']);
    }

    // User: Cancel reservation
    public function destroy(Reservation $reservation)
    {
        if ($reservation->Matricule !== Auth::user()->Matricule) {
            abort(403);
        }

        $reservation->delete();
        return back()->with('success', 'Reservation canceled!');
    }

    // Admin: Show all reservations
    public function adminIndex()
    {
        $reservations = Reservation::with('compte')
            ->orderBy('DateReservation', 'desc')
            ->paginate(10);

        return view('admin.reservations', compact('reservations'));
    }

    // Admin: Delete any reservation
    public function adminDestroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success', 'Reservation deleted!');
    }

    // Admin: Show statistics
    public function statistics()
    {
        $totalUsers = Compte::count();
        $totalReservations = Reservation::count();

        $reservationsByType = [
            'petit_dejeuner' => Reservation::where('Repas1', true)->count(),
            'dejeuner' => Reservation::where('Repas2', true)->count(),
            'diner' => Reservation::where('Repas3', true)->count(),
        ];

        return view('admin.statistics', compact('totalUsers', 'totalReservations', 'reservationsByType'));
    }
}
