<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeEvenementRequest;
use App\Models\TypeEvenement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TypeEvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $typeEvenements = TypeEvenement::latest()->paginate(10);
        
        return view('type-evenements.index', compact('typeEvenements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('type-evenements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeEvenementRequest $request): RedirectResponse
    {
        TypeEvenement::create($request->validated());

        return redirect()
            ->route('type-evenements.index')
            ->with('success', 'Type d\'événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeEvenement $typeEvenement): View
    {
        $typeEvenement->load('evenements');
        
        return view('type-evenements.show', compact('typeEvenement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeEvenement $typeEvenement): View
    {
        return view('type-evenements.edit', compact('typeEvenement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeEvenementRequest $request, TypeEvenement $typeEvenement): RedirectResponse
    {
        $typeEvenement->update($request->validated());

        return redirect()
            ->route('type-evenements.index')
            ->with('success', 'Type d\'événement modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeEvenement $typeEvenement): RedirectResponse
    {
        try {
            $typeEvenement->delete();
            
            return redirect()
                ->route('type-evenements.index')
                ->with('success', 'Type d\'événement supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->route('type-evenements.index')
                ->with('error', 'Impossible de supprimer ce type d\'événement car il est utilisé.');
        }
    }
}
