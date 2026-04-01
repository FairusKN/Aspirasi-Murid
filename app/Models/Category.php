<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUuids;

    protected $fillable = [
        'category_name'
    ];

    public function recipients(): HasMany
    {
        return $this->hasMany(CategoryRecipient::class, 'category_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'category_id');
    }
}
