<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $absences = Absence::with('employe')->paginate(15);
        return view('absences.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employes = Employe::all();
        return view('absences.create', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
            'commentaire' => 'nullable|string',
        ]);

        $validated['jours_absence'] = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays(\Carbon\Carbon::parse($validated['date_fin'])) + 1;
        $validated['statut'] = 'en_attente';
        $validated['date_declaration'] = now();

        Absence::create($validated);

        return redirect()->route('absences.index')->with('success', 'Absence créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence): View
    {
        $absence->load('employe', 'piecesJustificatives');
        return view('absences.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence): View
    {
        $employes = Employe::all();
        return view('absences.edit', compact('absence', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence): RedirectResponse
    {
        $validated = $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'motif' => 'required|string|max:255',
            'statut' => 'required|in:justifiee,non_justifiee,en_attente',
            'commentaire' => 'nullable|string',
        ]);

        $validated['jours_absence'] = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays(\Carbon\Carbon::parse($validated['date_fin'])) + 1;

        $absence->update($validated);

        return redirect()->route('absences.index')->with('success', 'Absence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence): RedirectResponse
    {
        $absence->delete();
        return redirect()->route('absences.index')->with('success', 'Absence supprimée avec succès.');
    }

    /**
     * API endpoint to get absences for a specific employee.
     */
    public function getByEmploye(Employe $employe): JsonResponse
    {
        $absences = $employe->absences()->with('piecesJustificatives')->get();
        return response()->json($absences);
    }

    /**
     * Approve an absence.
     */
    public function approuver(Absence $absence): RedirectResponse
    {
        $absence->update(['statut' => 'justifiee']);
        return redirect()->back()->with('success', 'Absence approuvée.');
    }

    /**
     * Reject an absence.
     */
    public function rejeter(Absence $absence): RedirectResponse
    {
        $absence->update(['statut' => 'non_justifiee']);
        return redirect()->back()->with('success', 'Absence rejetée.');
    }
}
