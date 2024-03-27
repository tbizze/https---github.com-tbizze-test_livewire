<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'date_published',
        'description',
    ];

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
    */
    protected $casts = [
        'date_published' => 'date:d/m/Y',
    ];

    /**
     * O Post 'pertence a uma' Category. 
     * Obtenha esse registro.
     */
    public function toCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id')
            ->withDefault(['title' => 'N/D']);
    }
}
