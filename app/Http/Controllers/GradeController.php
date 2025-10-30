<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Requests\GradeRequest;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Grade::query();

        // Recherche par libellé
        if ($request->filled('search')) {
            $query->where('libelle', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sortBy = $request->get('sort_by', 'libelle');
        $sortDirection = $request->get('sort_direction', 'asc');

        $query->orderBy($sortBy, $sortDirection);

        $grades = $query->paginate(15);

        // Statistiques
        $totalGrades = Grade::count();
        $totalEmployes = Grade::withCount('employes')->get()->sum('employes_count');
        $salaireMoyen = Grade::avg('salaire_base');

        return view('grades.index', compact('grades', 'totalGrades', 'totalEmployes', 'salaireMoyen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        try {
            Grade::create($request->validated());

            return redirect()
                ->route('grades.index')
                ->with('success', 'Grade créé avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du grade: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        // Charger les employés avec leurs relations
        $grade->load(['employes.direction', 'employes.profil']);

        // Statistiques du grade
        $stats = [
            'total_employes' => $grade->employes->count(),
            'employes_par_direction' => $grade->employes->groupBy('direction.nom')->map->count(),
            'employes_par_profil' => $grade->employes->groupBy('profil.nom')->map->count(),
            'employes_disponibles' => $grade->employes->where('disponibilite', true)->count(),
            'salaire_total' => $grade->employes->count() * $grade->salaire_base,
        ];

        return view('grades.show', compact('grade', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade)
    {
        try {
            $grade->update($request->validated());

            return redirect()
                ->route('grades.show', $grade)
                ->with('success', 'Grade mis à jour avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du grade: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        try {
            // Vérifier si le grade a des employés
            if ($grade->employes()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer ce grade car il est assigné à des employés.');
            }

            $grade->delete();

            return redirect()
                ->route('grades.index')
                ->with('success', 'Grade supprimé avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression du grade: ' . $e->getMessage());
        }
    }
}
