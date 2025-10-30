<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'employes';
    protected $primaryKey = 'id_employe';
    public $incrementing = true;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'situation_familiale',
        'nombre_enfants',
        'adresse',
        'ville',
        'code_postal',
        'pays',
        'poste',
        'date_embauche',
        'date_fin_contrat',
        'type_contrat',
        'statut',
        'salaire',
        'photo',
        'numero_securite_sociale',
        'iban',
        'bic',
        'notes',
        'disponibilite',
        'id_direction',
        'id_grade',
        'id_profil_employe'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_embauche' => 'date',
        'date_fin_contrat' => 'date',
        'disponibilite' => 'boolean',
        'salaire' => 'decimal:2',
        'nombre_enfants' => 'integer',
    ];

    // Relations
    public function direction(): BelongsTo
    {
        return $this->belongsTo(Direction::class, 'id_direction', 'id_direction');
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'id_grade', 'id_grade');
    }

    public function profil(): BelongsTo
    {
        return $this->belongsTo(Profil::class, 'id_profil_employe', 'id_profil_employe');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'id_employe', 'id_employe');
    }

    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class, 'id_employe', 'id_employe');
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class, 'id_employe', 'id_employe');
    }

    public function formations(): BelongsToMany
    {
        return $this->belongsToMany(Formation::class, 'employe_formations', 'id_employe', 'id_formation')
            ->withPivot('statut', 'note', 'commentaire')
            ->withTimestamps();
    }

    public function evenements(): BelongsToMany
    {
        return $this->belongsToMany(Evenement::class, 'employe_evenements', 'id_employe', 'id_evenement')
            ->withPivot('statut_participation', 'commentaire')
            ->withTimestamps();
    }

    public function evenementsOrganises(): HasMany
    {
        return $this->hasMany(Evenement::class, 'organisateur_id', 'id_employe');
    }

    // Accesseurs
    public function getNomCompletAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    public function getAgeAttribute(): int
    {
        return $this->date_naissance->age ?? 0;
    }

    public function getAncienneteAttribute(): int
    {
        return $this->date_embauche->diffInYears(now());
    }
}
