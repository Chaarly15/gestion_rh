<?php

namespace App\Http\Controllers;

use App\Models\Conge;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Conge::with(['employe', 'typeConge', 'valideur']);

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('id_type_conge')) {
            $query->where('id_type_conge', $request->id_type_conge);
        }

        if ($request->filled('id_employe')) {
            $query->where('id_employe', $request->id_employe);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('date_debut', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_fin', '<=', $request->date_fin);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('employe', function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('matricule', 'like', "%{$search}%");
            });
        }

        $conges = $query->orderBy('date_debut', 'desc')->paginate(15);
        $typeConges = TypeConge::orderBy('libelle')->get();
        $employes = Employe::orderBy('nom')->get();

        return view('conges.index', compact('conges', 'typeConges', 'employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $employes = Employe::where('statut', 'Actif')->orderBy('nom')->get();
        $typeConges = TypeConge::orderBy('libelle')->get();

        return view('conges.create', compact('employes', 'typeConges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'id_type_conge' => 'required|exists:type_conges,id_type_conge',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'libelle' => 'nullable|string|max:255',
            'motif' => 'nullable|string',
            'commentaire' => 'nullable|string',
        ]);

        $validated['statut'] = 'en_attente';

        Conge::create($validated);

        return redirect()->route('conges.index')
            ->with('success', 'Demande de congé créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conge $conge): View
    {
        $conge->load(['employe', 'typeConge', 'valideur', 'piecesJustificatives']);
        return view('conges.show', compact('conge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conge $conge): View
    {
        $employes = Employe::orderBy('nom')->get();
        $typeConges = TypeConge::orderBy('libelle')->get();

        return view('conges.edit', compact('conge', 'employes', 'typeConges'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conge $conge): RedirectResponse
    {
        $validated = $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'id_type_conge' => 'required|exists:type_conges,id_type_conge',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'libelle' => 'nullable|string|max:255',
            'motif' => 'nullable|string',
            'commentaire' => 'nullable|string',
            'statut' => 'required|in:en_attente,approuve,rejete,annule',
            'motif_rejet' => 'nullable|string',
        ]);

        $conge->update($validated);

        return redirect()->route('conges.index')
            ->with('success', 'Congé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conge $conge): RedirectResponse
    {
        $conge->delete();
        return redirect()->route('conges.index')
            ->with('success', 'Congé supprimé avec succès.');
    }

    /**
     * Approve a leave request.
     */
    public function approuver(Conge $conge): RedirectResponse
    {
        $conge->valider(auth()->id());
        return redirect()->back()
            ->with('success', 'Congé approuvé avec succès.');
    }

    /**
     * Reject a leave request.
     */
    public function rejeter(Request $request, Conge $conge): RedirectResponse
    {
        $request->validate([
            'motif_rejet' => 'required|string',
        ]);

        $conge->update([
            'statut' => 'rejete',
            'motif_rejet' => $request->motif_rejet,
            'date_validation' => now(),
            'valideur_id' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Congé rejeté.');
    }
}
