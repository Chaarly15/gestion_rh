<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Formation::withCount('employes');

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
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
                  ->orWhere('formateur', 'like', "%{$search}%");
            });
        }

        $formations = $query->orderBy('date_debut', 'desc')->paginate(15);

        return view('formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('formations.create');
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
            'duree_heures' => 'nullable|integer|min:1',
            'formateur' => 'nullable|string|max:255',
            'cout' => 'nullable|numeric|min:0',
            'statut' => 'required|in:planifiee,en_cours,terminee,annulee',
        ]);

        Formation::create($validated);

        return redirect()->route('formations.index')
            ->with('success', 'Formation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation): View
    {
        $formation->load('employes');
        return view('formations.show', compact('formation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation): View
    {
        return view('formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation): RedirectResponse
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'duree_heures' => 'nullable|integer|min:1',
            'formateur' => 'nullable|string|max:255',
            'cout' => 'nullable|numeric|min:0',
            'statut' => 'required|in:planifiee,en_cours,terminee,annulee',
        ]);

        $formation->update($validated);

        return redirect()->route('formations.index')
            ->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation): RedirectResponse
    {
        $formation->delete();
        return redirect()->route('formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }

    /**
     * Inscrire un employé à une formation.
     */
    public function inscrire(Request $request, Formation $formation): RedirectResponse
    {
        $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
        ]);

        $employe = Employe::findOrFail($request->id_employe);

        try {
            $formation->inscrire($employe);
            return redirect()->back()
                ->with('success', 'Employé inscrit avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Désinscrire un employé d'une formation.
     */
    public function desinscrire(Formation $formation, Employe $employe): RedirectResponse
    {
        $formation->desinscrire($employe);
        return redirect()->back()
            ->with('success', 'Employé désinscrit avec succès.');
    }
}
