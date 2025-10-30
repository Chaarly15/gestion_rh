<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\ProfilRequest;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Profil::query();

        // Recherche par nom
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sortBy = $request->get('sort_by', 'nom');
        $sortDirection = $request->get('sort_direction', 'asc');

        $query->orderBy($sortBy, $sortDirection);

        $profils = $query->paginate(15);

        // Statistiques
        $totalProfils = Profil::count();
        $totalEmployes = Profil::withCount('employes')->get()->sum('employes_count');

        return view('profils.index', compact('profils', 'totalProfils', 'totalEmployes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfilRequest $request)
    {
        try {
            Profil::create($request->validated());

            return redirect()
                ->route('profils.index')
                ->with('success', 'Profil créé avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du profil: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
    {
        // Charger les employés avec leurs relations
        $profil->load(['employes.direction', 'employes.grade']);

        // Statistiques du profil
        $stats = [
            'total_employes' => $profil->employes->count(),
            'employes_par_direction' => $profil->employes->groupBy('direction.nom')->map->count(),
            'employes_par_grade' => $profil->employes->groupBy('grade.libelle')->map->count(),
            'employes_disponibles' => $profil->employes->where('disponibilite', true)->count(),
        ];

        return view('profils.show', compact('profil', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
    {
        return view('profils.edit', compact('profil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfilRequest $request, Profil $profil)
    {
        try {
            $profil->update($request->validated());

            return redirect()
                ->route('profils.show', $profil)
                ->with('success', 'Profil mis à jour avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du profil: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        try {
            // Vérifier si le profil a des employés
            if ($profil->employes()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer ce profil car il est assigné à des employés.');
            }

            $profil->delete();

            return redirect()
                ->route('profils.index')
                ->with('success', 'Profil supprimé avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression du profil: ' . $e->getMessage());
        }
    }
}
