<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeCongeRequest;
use App\Models\TypeConge;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TypeCongeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $typeConges = TypeConge::latest()->paginate(10);
        
        return view('type-conges.index', compact('typeConges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('type-conges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeCongeRequest $request): RedirectResponse
    {
        TypeConge::create($request->validated());

        return redirect()
            ->route('type-conges.index')
            ->with('success', 'Type de congé créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeConge $typeConge): View
    {
        $typeConge->load('conges');
        
        return view('type-conges.show', compact('typeConge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeConge $typeConge): View
    {
        return view('type-conges.edit', compact('typeConge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeCongeRequest $request, TypeConge $typeConge): RedirectResponse
    {
        $typeConge->update($request->validated());

        return redirect()
            ->route('type-conges.index')
            ->with('success', 'Type de congé modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeConge $typeConge): RedirectResponse
    {
        try {
            $typeConge->delete();
            
            return redirect()
                ->route('type-conges.index')
                ->with('success', 'Type de congé supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->route('type-conges.index')
                ->with('error', 'Impossible de supprimer ce type de congé car il est utilisé.');
        }
    }
}
