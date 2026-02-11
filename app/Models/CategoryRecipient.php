<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CategoryRecipient extends Model
{
    use HasUuids;

    protected $fillable = [
        'full_name',
        'from_category',
        'email',
        'is_active'
    ];
}
