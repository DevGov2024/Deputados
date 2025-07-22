php artisan sync:deputados
      │
      ├── Busca todos os deputados da API
      │
      ├── Para cada deputado:
      │     ├── Salva ou atualiza no banco
      │     ├── Dispara SyncDespesasJob(deputado_id)
      │
      └── Termina

Cada SyncDespesasJob roda separadamente:
      │
      ├── Busca despesas do deputado na API
      │
      ├── Salva todas as despesas no banco
      │
      └── Termina
