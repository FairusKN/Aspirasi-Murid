<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enum\LogAction;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AutditLog extends Model
{
    use HasUuids;

    protected $fillable = [
        "admin_id",
        "action",
        'details',
        "admin_ip"
    ];

    /**
     * @param LogAction $action
     * @return void
     **/
    static function createLogging(LogAction $action, string $details): void
    {
        $user = Auth::user();

        // Check if user is an admin or above, if not return void
        if (!in_array($user->role, [
            UserRole::Admin->value,
            UserRole::SuperAdmin->value
        ])) return;

        self::create([
            'admin_id' => $user->id,
            'action' => $action->value,
            'admin_ip' => Request::ip(),
            'details' => $details
        ]);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, "admin_id");
    }
}
