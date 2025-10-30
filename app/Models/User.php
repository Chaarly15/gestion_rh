<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relation avec le modèle Employe
     * Un utilisateur peut être lié à un employé via l'email
     */
    public function employe(): HasOne
    {
        return $this->hasOne(Employe::class, 'email', 'email');
    }

    /**
     * Vérifier si l'utilisateur a un rôle spécifique
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('Administrateur');
    }

    public function isRH(): bool
    {
        return $this->hasRole('RH');
    }

    public function isManager(): bool
    {
        return $this->hasRole('Manager');
    }

    public function isEmploye(): bool
    {
        return $this->hasRole('Employé');
    }

    /**
     * Vérifier si l'utilisateur peut gérer un employé spécifique
     */
    public function canManageEmploye(Employe $employe): bool
    {
        // Admin et RH peuvent gérer tous les employés
        if ($this->isAdmin() || $this->isRH()) {
            return true;
        }

        // Manager peut gérer les employés de sa direction
        if ($this->isManager() && $this->employe) {
            return $employe->direction_id === $this->employe->direction_id;
        }

        // Employé peut gérer uniquement ses propres données
        if ($this->isEmploye() && $this->employe) {
            return $employe->id === $this->employe->id;
        }

        return false;
    }

    /**
     * Obtenir le nom complet de l'utilisateur
     */
    public function getFullNameAttribute(): string
    {
        return $this->employe ? $this->employe->nom_complet : $this->name;
    }
}
