<?php

namespace App\Http\Controllers;

use App\Exports\EmployesExport;
use App\Http\Requests\EmployeRequest;
use App\Models\Direction;
use App\Models\Employe;
use App\Models\Grade;
use App\Models\Profil;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;

class EmployeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Employe::class);

        $query = Employe::with(['direction', 'grade', 'profil']);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('matricule', 'like', "%{$search}%")
                  ->orWhere('poste', 'like', "%{$search}%");
            });
        }

        // Filtres
        if ($request->filled('direction')) {
            $query->where('id_direction', $request->direction);
        }

        if ($request->filled('grade')) {
            $query->where('id_grade', $request->grade);
        }

        if ($request->filled('profil')) {
            $query->where('id_profil_employe', $request->profil);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('type_contrat')) {
            $query->where('type_contrat', $request->type_contrat);
        }

        // Tri
        $sortBy = $request->get('sort_by', 'nom');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $employes = $query->paginate(15)->withQueryString();

        // Données pour les filtres
        $directions = Direction::orderBy('nom')->get();
        $grades = Grade::orderBy('libelle')->get();
        $profils = Profil::orderBy('nom')->get();

        return view('employes.index', compact('employes', 'directions', 'grades', 'profils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Employe::class);

        $directions = Direction::orderBy('nom')->get();
        $grades = Grade::orderBy('libelle')->get();
        $profils = Profil::orderBy('nom')->get();

        return view('employes.create', compact('directions', 'grades', 'profils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeRequest $request): RedirectResponse
    {
        $this->authorize('create', Employe::class);

        $data = $request->validated();

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->handlePhotoUpload($request->file('photo'));
        }

        $employe = Employe::create($data);

        return redirect()
            ->route('employes.show', $employe)
            ->with('success', 'Employé créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe): View
    {
        $this->authorize('view', $employe);

        $employe->load(['direction', 'grade', 'profil', 'conges', 'absences', 'formations', 'documents']);

        return view('employes.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe): View
    {
        $this->authorize('update', $employe);

        $directions = Direction::orderBy('nom')->get();
        $grades = Grade::orderBy('libelle')->get();
        $profils = Profil::orderBy('nom')->get();

        return view('employes.edit', compact('employe', 'directions', 'grades', 'profils'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeRequest $request, Employe $employe): RedirectResponse
    {
        $this->authorize('update', $employe);

        $data = $request->validated();

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($employe->photo && Storage::disk('public')->exists($employe->photo)) {
                Storage::disk('public')->delete($employe->photo);
            }
            $data['photo'] = $this->handlePhotoUpload($request->file('photo'));
        }

        $employe->update($data);

        return redirect()
            ->route('employes.show', $employe)
            ->with('success', 'Employé modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe): RedirectResponse
    {
        $this->authorize('delete', $employe);

        // Supprimer la photo
        if ($employe->photo && Storage::disk('public')->exists($employe->photo)) {
            Storage::disk('public')->delete($employe->photo);
        }

        // Soft delete
        $employe->delete();

        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé supprimé avec succès.');
    }

    /**
     * Upload and process employee photo.
     */
    private function handlePhotoUpload($file): string
    {
        // Créer un nom unique pour le fichier
        $filename = 'employe_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Créer le manager d'images avec le driver GD
        $manager = new ImageManager(new Driver());

        // Lire et traiter l'image
        $image = $manager->read($file);

        // Redimensionner à 300x300 en conservant les proportions
        $image->cover(300, 300);

        // Sauvegarder dans storage/app/public/photos
        $path = 'photos/' . $filename;
        Storage::disk('public')->put($path, (string) $image->encode());

        return $path;
    }

    /**
     * Export employees to Excel.
     */
    public function exportExcel()
    {
        $this->authorize('export', Employe::class);

        return Excel::download(new EmployesExport, 'employes_' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Export employees to PDF.
     */
    public function exportPdf()
    {
        $this->authorize('export', Employe::class);

        $employes = Employe::with(['direction', 'grade', 'profil'])->get();

        $pdf = Pdf::loadView('employes.pdf', compact('employes'));

        return $pdf->download('employes_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Upload or update employee photo.
     */
    public function uploadPhoto(Request $request, Employe $employe): RedirectResponse
    {
        $this->authorize('update', $employe);

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Supprimer l'ancienne photo si elle existe
        if ($employe->photo && Storage::disk('public')->exists($employe->photo)) {
            Storage::disk('public')->delete($employe->photo);
        }

        // Upload de la nouvelle photo
        $photoPath = $this->handlePhotoUpload($request->file('photo'));

        $employe->update(['photo' => $photoPath]);

        return redirect()
            ->back()
            ->with('success', 'Photo mise à jour avec succès.');
    }
}
