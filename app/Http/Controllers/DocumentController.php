<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employe;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_employe' => 'required|exists:employes,id_employe',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240', // Max 10MB
            'type_document' => 'required|string|in:CV,Contrat,Diplôme,Certificat,Attestation,Autre',
            'description' => 'nullable|string|max:500',
        ], [
            'fichier.required' => 'Veuillez sélectionner un fichier.',
            'fichier.mimes' => 'Le fichier doit être de type: PDF, Word, Excel, JPG, JPEG ou PNG.',
            'fichier.max' => 'Le fichier ne peut pas dépasser 10 Mo.',
            'type_document.required' => 'Le type de document est obligatoire.',
            'type_document.in' => 'Le type de document sélectionné est invalide.',
        ]);

        $employe = Employe::findOrFail($request->id_employe);

        // Vérifier les autorisations
        if (!auth()->user()->isAdmin() && !auth()->user()->isRH()) {
            // Un employé ne peut uploader que ses propres documents
            if ($employe->email !== auth()->user()->email) {
                abort(403, 'Vous n\'êtes pas autorisé à uploader des documents pour cet employé.');
            }
        }

        $file = $request->file('fichier');
        $nomOriginal = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $nomFichier = 'doc_' . $employe->id_employe . '_' . uniqid() . '.' . $extension;

        // Stocker le fichier dans storage/app/documents
        $chemin = $file->storeAs('documents', $nomFichier);

        Document::create([
            'id_employe' => $request->id_employe,
            'nom_fichier' => $nomFichier,
            'nom_original' => $nomOriginal,
            'type_document' => $request->type_document,
            'taille' => $file->getSize(),
            'chemin' => $chemin,
            'description' => $request->description,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Document uploadé avec succès.');
    }

    /**
     * Download the specified resource.
     */
    public function show(Document $document): Response
    {
        // Vérifier les autorisations
        if (!auth()->user()->isAdmin() && !auth()->user()->isRH()) {
            // Un employé ne peut télécharger que ses propres documents
            if ($document->employe->email !== auth()->user()->email) {
                abort(403, 'Vous n\'êtes pas autorisé à télécharger ce document.');
            }
        }

        if (!Storage::exists($document->chemin)) {
            abort(404, 'Fichier introuvable.');
        }

        return response()->download(
            storage_path('app/' . $document->chemin),
            $document->nom_original
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document): RedirectResponse
    {
        // Vérifier les autorisations
        if (!auth()->user()->isAdmin() && !auth()->user()->isRH()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer ce document.');
        }

        // Supprimer le fichier physique
        if (Storage::exists($document->chemin)) {
            Storage::delete($document->chemin);
        }

        $document->delete();

        return redirect()
            ->back()
            ->with('success', 'Document supprimé avec succès.');
    }
}
