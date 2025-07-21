<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Deputado;
use App\Models\Despesa;

class SyncDespesasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $deputado_id_api;

    public function __construct($deputado_id_api)
    {
        $this->deputado_id_api = $deputado_id_api;
    }

    public function handle()
    {
        $deputado = Deputado::where('id_api', $this->deputado_id_api)->first();

        if (!$deputado) {
            return;
        }

        $response = Http::get("https://dadosabertos.camara.leg.br/api/v2/deputados/{$this->deputado_id_api}/despesas");
        if (!$response->ok()) {
            return;
        }

        $despesas = $response->json()['dados'];

        foreach ($despesas as $d) {
            Despesa::updateOrCreate(
                [
                    'deputado_id' => $deputado->id,
                    'cod_documento' => $d['codDocumento'],
                ],
                [
                    'ano' => $d['ano'],
                    'mes' => $d['mes'],
                    'tipo_despesa' => $d['tipoDespesa'],
                    'tipo_documento' => $d['tipoDocumento'] ?? null,
                    'data_documento' => $d['dataDocumento'] ?? null,
                    'num_documento' => $d['numDocumento'] ?? null,
                    'valor_documento' => $d['valorDocumento'] ?? 0,
                    'url_documento' => $d['urlDocumento'] ?? null,
                    'nome_fornecedor' => $d['nomeFornecedor'] ?? null,
                    'cnpj_cpf_fornecedor' => $d['cnpjCpfFornecedor'] ?? null,
                ]
            );
        }
    }
}
