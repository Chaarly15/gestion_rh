<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TypeCongeController;
use App\Http\Controllers\TypeEvenementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\PieceJustificativeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\EmployeFormationController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\EmployeEvenementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SoldeCongeController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;

Route::view('/', 'index');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Routes pour les directions
Route::resource('directions', DirectionController::class)->middleware(['auth']);

// Routes pour les grades
Route::resource('grades', GradeController::class)->middleware(['auth']);

// Routes pour les profils
Route::resource('profils', ProfilController::class)->middleware(['auth']);

// Routes pour les types de congés
Route::resource('type-conges', TypeCongeController::class)->middleware(['auth']);

// Routes pour les types d'événements
Route::resource('type-evenements', TypeEvenementController::class)->middleware(['auth']);

// Routes pour les employés
Route::middleware(['auth'])->group(function () {
    Route::resource('employes', EmployeController::class);

    // Upload photo employé
    Route::post('employes/{employe}/photo', [EmployeController::class, 'uploadPhoto'])
        ->name('employes.photo');

    // Export employés
    Route::get('employes-export/excel', [EmployeController::class, 'exportExcel'])
        ->name('employes.export.excel');

    Route::get('employes-export/pdf', [EmployeController::class, 'exportPdf'])
        ->name('employes.export.pdf');
});

// Routes pour les congés
Route::middleware(['auth'])->group(function () {
    Route::resource('conges', CongeController::class);

    // Actions métier pour les congés
    Route::post('conges/{conge}/approuver', [CongeController::class, 'approuver'])
        ->name('conges.approuver');
    Route::post('conges/{conge}/rejeter', [CongeController::class, 'rejeter'])
        ->name('conges.rejeter');
});

// Routes pour les absences
Route::middleware(['auth'])->group(function () {
    Route::resource('absences', AbsenceController::class);

    // Actions métier pour les absences
    Route::post('absences/{absence}/approuver', [AbsenceController::class, 'approuver'])
        ->name('absences.approuver');
    Route::post('absences/{absence}/rejeter', [AbsenceController::class, 'rejeter'])
        ->name('absences.rejeter');
});

// Routes pour les pièces justificatives
Route::resource('piece-justificatives', PieceJustificativeController::class)->middleware(['auth']);

// Routes pour les formations
Route::middleware(['auth'])->group(function () {
    Route::resource('formations', FormationController::class);

    // Actions métier pour les formations
    Route::post('formations/{formation}/inscrire', [FormationController::class, 'inscrireEmploye'])
        ->name('formations.inscrire');
    Route::delete('formations/{formation}/desinscrire/{employe}', [FormationController::class, 'desinscrireEmploye'])
        ->name('formations.desinscrire');
});

// Routes pour les employés-formations
Route::resource('employe-formations', EmployeFormationController::class)->middleware(['auth']);

// Routes pour les événements
Route::middleware(['auth'])->group(function () {
    Route::resource('evenements', EvenementController::class);

    // Actions métier pour les événements
    Route::post('evenements/{evenement}/participants', [EvenementController::class, 'ajouterParticipant'])
        ->name('evenements.participants.add');
    Route::delete('evenements/{evenement}/participants/{employe}', [EvenementController::class, 'retirerParticipant'])
        ->name('evenements.participants.remove');
});

// Routes pour les employés-événements
Route::resource('employe-evenements', EmployeEvenementController::class)->middleware(['auth']);

// Routes pour les notifications
Route::resource('notifications', NotificationController::class)->middleware(['auth']);

// Routes pour les soldes de congés
Route::resource('solde-conges', SoldeCongeController::class)->middleware(['auth']);

// Routes pour les logs d'audit
Route::resource('audit-logs', AuditLogController::class)->middleware(['auth']);

// Routes pour les documents
Route::middleware(['auth'])->group(function () {
    Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
});

require __DIR__.'/auth.php';
