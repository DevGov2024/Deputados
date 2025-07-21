<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Deputados e Despesas</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h1 { margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #eee; }
        .despesa { background: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Deputados e suas Despesas</h1>

    @foreach ($deputados as $deputado)
        <h2>{{ $deputado->nome }} ({{ $deputado->sigla_partido }} - {{ $deputado->sigla_uf }})</h2>
        @if ($deputado->despesas->isEmpty())
            <p><em>Sem despesas cadastradas.</em></p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Mês</th>
                        <th>Tipo Despesa</th>
                        <th>Valor</th>
                        <th>Fornecedor</th>
                        <th>Documento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deputado->despesas as $despesa)
                        <tr class="despesa">
                            <td>{{ $despesa->ano }}</td>
                            <td>{{ $despesa->mes }}</td>
                            <td>{{ $despesa->tipo_despesa }}</td>
                            <td>R$ {{ number_format($despesa->valor_documento, 2, ',', '.') }}</td>
                            <td>{{ $despesa->nome_fornecedor }}</td>
                            <td>
                                @if($despesa->url_documento)
                                    <a href="{{ $despesa->url_documento }}" target="_blank">Link</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach

    {{ $deputados->links() }}

</body>
</html>
