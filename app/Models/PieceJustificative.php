<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PieceJustificative extends Model
{
    protected $table = 'pieces_justificatives';
    protected $primaryKey = 'id_piece_justificative';

    protected $fillable = [
        'libelle',
        'fichier',
        'type_fichier',
        'taille_fichier',
        'date_ajout',
        'commentaire',
        'id_absence',
        'uploaded_by',
    ];

    protected $casts = [
        'date_ajout' => 'date',
        'taille_fichier' => 'integer',
    ];

    // Relations
    public function absence(): BelongsTo
    {
        return $this->belongsTo(Absence::class, 'id_absence');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Accesseurs
    public function getUrlAttribute(): string
    {
        return Storage::url('public/' . $this->fichier);
    }

    public function getTailleHumainAttribute(): string
    {
        $taille = $this->taille_fichier;
        
        if ($taille < 1024) {
            return $taille . ' Ko';
        } elseif ($taille < 1048576) {
            return round($taille / 1024, 2) . ' Mo';
        }
        
        return round($taille / 1048576, 2) . ' Go';
    }

    // Méthodes
    public function download()
    {
        return response()->download(storage_path('app/public/' . $this->fichier), $this->libelle);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($piece) {
            if (Storage::disk('public')->exists($piece->fichier)) {
                Storage::disk('public')->delete($piece->fichier);
            }
        });
    }
}
