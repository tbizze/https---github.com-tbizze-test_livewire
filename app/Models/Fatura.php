<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fatura extends Model
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
        'dt_venc', 'dt_pgto', 'valor_fatura', 'valor_pgto', 'notas', 'fatura_emissora_id', 'pgto_forma_id', 'status_id'
    ];

    /**
     * Define colunas c/ datas p/ usar Carbon. 
    */
    protected $casts = [
        'dt_venc' => 'date:d/m/Y',
        'dt_pgto' => 'date:d/m/Y',
    ];

    /**
     * RELACIONAMENTO: A Fatura 'tem muitos' (hasMany) FaturaItems.
     * Obtenha essa coleção de registros.
     */
    public function hasFaturaItens(): HasMany
    {
        return $this->hasMany(FaturaItem::class);
    }

    /**
     * RELACIONAMENTO: A Fatura 'pertence a uma' FaturaEmissora. 
     * Obtenha esse registro.
     */
    public function toFaturaEmissora(): BelongsTo
    {
        return $this->belongsTo(FaturaEmissora::class,'fatura_emissora_id');
    }
}
