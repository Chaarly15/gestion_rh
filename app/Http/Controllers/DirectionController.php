<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Http\Requests\DirectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Direction::query();

        // Recherche par nom
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }

        // Tri
        $sortBy = $request->get('sort_by', 'nom');
        $sortDirection = $request->get('sort_direction', 'asc');

        $query->orderBy($sortBy, $sortDirection);

        $directions = $query->paginate(15);

        // Statistiques
        $totalDirections = Direction::count();
        $totalEmployes = Direction::withCount('employes')->get()->sum('employes_count');

        return view('directions.index', compact('directions', 'totalDirections', 'totalEmployes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('directions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DirectionRequest $request)
    {
        try {
            Direction::create($request->validated());

            return redirect()
                ->route('directions.index')
                ->with('success', 'Direction créée avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création de la direction: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        // Charger les employés avec leurs relations
        $direction->load(['employes.grade', 'employes.profil']);

        // Statistiques de la direction
        $stats = [
            'total_employes' => $direction->employes->count(),
            'employes_par_grade' => $direction->employes->groupBy('grade.libelle')->map->count(),
            'employes_par_profil' => $direction->employes->groupBy('profil.nom')->map->count(),
            'employes_disponibles' => $direction->employes->where('disponibilite', true)->count(),
        ];

        return view('directions.show', compact('direction', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direction $direction)
    {
        return view('directions.edit', compact('direction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DirectionRequest $request, Direction $direction)
    {
        try {
            $direction->update($request->validated());

            return redirect()
                ->route('directions.show', $direction)
                ->with('success', 'Direction mise à jour avec succès.');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour de la direction: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {
        try {
            // Vérifier si la direction a des employés
            if ($direction->employes()->count() > 0) {
                return back()->with('error', 'Impossible de supprimer cette direction car elle contient des employés.');
            }

            $direction->delete();

            return redirect()
                ->route('directions.index')
                ->with('success', 'Direction supprimée avec succès.');

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de la direction: ' . $e->getMessage());
        }
    }
}
