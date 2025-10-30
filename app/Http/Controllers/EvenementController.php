<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Employe;
use App\Models\TypeEvenement;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Evenement::with(['typeEvenement', 'organisateur'])->withCount('participants');

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('id_type_evenement')) {
            $query->where('id_type_evenement', $request->id_type_evenement);
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
            $query->where(function($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('lieu', 'like', "%{$search}%");
            });
        }

        $evenements = $query->orderBy('date_debut', 'desc')->paginate(15);
        $typeEvenements = TypeEvenement::orderBy('nom')->get();

        return view('evenements.index', compact('evenements', 'typeEvenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $typeEvenements = TypeEvenement::orderBy('nom')->get();
        $employes = Employe::where('statut', 'Actif')->orderBy('nom')->get();

        return view('evenements.create', compact('typeEvenements', 'employes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'heure_debut' => 'nullable|date_format:H:i',
            'heure_fin' => 'nullable|date_format:H:i',
            'lieu' => 'nullable|string|max:255',
            'statut' => 'required|in:planifie,en_cours,termine,annule',
            'organisateur_id' => 'nullable|exists:employes,id_employe',
            'id_type_evenement' => 'required|exists:type_evenements,id_type_evenement',
        ]);

        Evenement::create($validated);

        return redirect()->route('evenements.index')
            ->with('success', 'Événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement): View
    {
        $evenement->load(['typeEvenement', 'organisateur', 'participants']);
        return view('evenements.show', compact('evenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evenement $evenement): View
    {
        $typeEvenements = TypeEvenement::orderBy('nom')->get();
        $employes = Employe::orderBy('nom')->get();

        return view('evenements.edit', compact('evenement', 'typeEvenements', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evenement $evenement): RedirectResponse
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'heure_debut' => 'nullable|date_format:H:i',
            'heure_fin' => 'nullable|date_format:H:i',
            'lieu' => 'nullable|string|max:255',
            'statut' => 'required|in:planifie,en_cours,termine,annule',
            'organisateur_id' => 'nullable|exists:employes,id_employe',
            'id_type_evenement' => 'required|exists:type_evenements,id_type_evenement',
        ]);

        $evenement->update($validated);

        return redirect()->route('evenements.index')
            ->with('success', 'Événement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement): RedirectResponse
    {
        $evenement->delete();
        return redirect()->route('evenements.index')
            ->with('success', 'Événement supprimé avec succès.');
    }

    /**
     * Ajouter un participant à un événement.
     */
    public function ajouterParticipant(Request $request, Evenement $evenement): RedirectResponse
    {
        $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'statut_participation' => 'nullable|in:invite,confirme,present,absent',
        ]);

        $evenement->participants()->attach($request->id_employe, [
            'statut_participation' => $request->statut_participation ?? 'invite',
        ]);

        return redirect()->back()
            ->with('success', 'Participant ajouté avec succès.');
    }

    /**
     * Retirer un participant d'un événement.
     */
    public function retirerParticipant(Evenement $evenement, Employe $employe): RedirectResponse
    {
        $evenement->participants()->detach($employe->id_employe);
        return redirect()->back()
            ->with('success', 'Participant retiré avec succès.');
    }
}
