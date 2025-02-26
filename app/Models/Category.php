<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * A Category 'tem muitos' (hasMany) Posts.
     * Obtenha essa coleção de registros.
     */
    public function hasPosts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
