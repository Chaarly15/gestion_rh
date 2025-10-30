<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    protected $table = 'audit_logs';

    protected $fillable = [
        'user_id',
        'action',
        'model',
        'model_id',
        'ip_address',
        'user_agent',
        'url',
        'old_data',
        'new_data',
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Méthodes statiques
    public static function log($action, $model = null, $modelId = null, $oldData = null, $newData = null)
    {
        return self::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $model ? class_basename($model) : null,
            'model_id' => $modelId,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'url' => request()->fullUrl(),
            'old_data' => $oldData,
            'new_data' => $newData,
        ]);
    }

    // Scopes
    public function scopeParUtilisateur($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeParAction($query, $action)
    {
        return $query->where('action', $action);
    }

    public function scopeParModele($query, $model)
    {
        return $query->where('model', $model);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
