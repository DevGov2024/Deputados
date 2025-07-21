<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'deputado_id',
        'ano',
        'mes',
        'tipo_despesa',
        'cod_documento',
        'tipo_documento',
        'data_documento',
        'num_documento',
        'valor_documento',
        'url_documento',
        'nome_fornecedor',
        'cnpj_cpf_fornecedor',
    ];

    public function deputado()
    {
        return $this->belongsTo(Deputado::class);
    }
}