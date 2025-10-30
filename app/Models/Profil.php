<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profil extends Model
{
    protected $table = 'profils';
    protected $primaryKey = 'id_profil_employe';

    protected $fillable = [
        'nom',
        'description'
    ];

    // Relations
    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'id_profil_employe', 'id_profil_employe');
    }
}
