<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direction extends Model
{
    use SoftDeletes;

    protected $table = 'directions';
    protected $primaryKey = 'id_direction';
    public $incrementing = true;

    protected $fillable = [
        'nom',
        'description'
    ];



    // Relations
    public function employes(): HasMany
    {
        return $this->hasMany(Employe::class, 'id_direction', 'id_direction');
    }
}
