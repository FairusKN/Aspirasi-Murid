<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutditLog extends Model
{
    use HasUuids;

    protected $fillable = [
        "admin_id",
        "action",
        "admin_ip"
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, "admin_id");
    }
}
