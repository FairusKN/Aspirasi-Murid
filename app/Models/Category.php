<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name'
    ];

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, "category_id");
    }
}
