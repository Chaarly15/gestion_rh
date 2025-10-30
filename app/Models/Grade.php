<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $table = 'grades';
    protected $primaryKey = 'id_grade';

    protected $fillable = [
        'libelle',
        'salaire_base',
        'description'
    ];

    protected $casts = [
        'salaire_base' => 'decimal:2',
    ];

    // Relations
    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'id_grade', 'id_grade');
    }

    // Accesseurs
    public function getSalaireBaseFormateAttribute(): string
    {
        return number_format($this->salaire_base, 2, ',', ' ') . ' €';
    }
}
