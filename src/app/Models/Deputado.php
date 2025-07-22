<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deputado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_api',
        'nome',
        'sigla_partido',
        'sigla_uf',
        'id_legislatura',
        'url_foto',
        'uri',
        'uri_partido',
    ];

    public function despesas()
    {
      return $this->hasMany(Despesa::class);
    }
}
