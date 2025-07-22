<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Deputado;
use App\Jobs\SyncDespesasJob;

class SyncDeputados extends Command
{
    protected $signature = 'sync:deputados';
    protected $description = 'Sincroniza deputados e suas despesas com a API da Câmara';

    public function handle()
    {
        $this->info("🔄 Buscando deputados da API...");

        $response = Http::get('https://dadosabertos.camara.leg.br/api/v2/deputados');
        if (!$response->ok()) {
            $this->error("❌ Erro ao acessar a API.");
            return;
        }

        $deputados = $response->json()['dados'];

        foreach ($deputados as $d) {
            $deputado = Deputado::updateOrCreate(
                ['id_api' => $d['id']],
                [
                    'nome' => $d['nome'],
                    'sigla_partido' => $d['siglaPartido'],
                    'sigla_uf' => $d['siglaUf'],
                    'id_legislatura' => $d['idLegislatura'] ?? null,
                    'url_foto' => $d['urlFoto'] ?? null,
                    'uri' => $d['uri'] ?? null,
                    'uri_partido' => $d['uriPartido'] ?? null,
                ]
            );

            $this->info("✅ Deputado sincronizado: {$deputado->nome}");

            
            SyncDespesasJob::dispatch($deputado->id_api);
        }

        $this->info("🎉 Todos os deputados foram sincronizados e Jobs para despesas foram enfileiradas.");
    }
}

