<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimento extends Model
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
        'dt_movimento', 'valor', 'tipo', 'historico', 'notas', 'movimento_grupo_id', 'pgto_tipo_id'
    ];    

    /**
     * Configura o formato da data p/ as colunas 'dt_lcto'.
    */
    protected $casts = [
        'dt_movimento' => 'date:d/m/Y',
    ];

    /**
     * RELACIONAMENTO: O Movimento 'pertence a uma' MovimentoGrupo. 
     * Obtenha esse registro.
     */
    public function toMovimentoGrupo(): BelongsTo
    {
        return $this->belongsTo(MovimentoGrupo::class,'movimento_grupo_id');
    }
    
    /**
     * RELACIONAMENTO: O Movimento 'pertence a uma' PgtoTipo. 
     * Obtenha esse registro.
     */
    public function toPgtoTipo(): BelongsTo
    {
        return $this->belongsTo(PgtoTipo::class,'pgto_tipo_id');
    }
}
