<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Enum\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FeedbackCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();

        return collect($this->resource)
            ->except([
                'user_id',
                'internal_notes',
                'deleted_at',
                'image'
            ])
            ->when(
                $this->isUserSuperAdmin($user),
                function ($data) {
                    $data->put('user_id', $this->user_id);
                    $data->load('student');
                }
            )
            ->when(
                isset($this->image),
                fn($data) => $data->put('image', Storage::url($this->image))
            )
            ->toArray();
    }

    protected function isUserSuperAdmin($user): bool
    {
        return $user->role === UserRole::SuperAdmin->value;
    }
}
