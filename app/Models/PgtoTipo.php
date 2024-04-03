<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PgtoTipo extends Model
{
    use HasFactory;

    /**
     * Habilita o recurso de excluir para Lixeira.
     */
    use SoftDeletes;

    /**
     * Lista de campos com persistência no BD. 
     */
    protected $fillable = [
        'nome', 'notas','ativo'
    ];


    /**
     * RELACIONAMENTO: O PgtoForma 'tem muitos' (hasMany) Movimentos.
     * Obtenha essa coleção de registros.
     */
    public function hasFaturaItens(): HasMany
    {
        return $this->hasMany(Movimento::class);
    }
}
