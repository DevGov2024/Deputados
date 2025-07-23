<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Deputados e Despesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4" style="background-color: #e5e9ecff">

    <h1 class="mb-4 text-center">Deputados e suas Despesas</h1>

    <!-- Filtros -->
    <form method="GET" action="{{ route('deputados.index') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="nome" class="form-control" placeholder="Nome do deputado" value="{{ request('nome') }}">
        </div>
        <div class="col-md-3">
            <select name="uf" class="form-select">
                <option value="">Todos os estados</option>
                @foreach ($ufs as $uf)
                    <option value="{{ $uf }}" {{ request('uf') == $uf ? 'selected' : '' }}>{{ $uf }}</option>
                @endforeach
            </select>  
        </div>
        <div class="col-md-3">
            <select name="partido" class="form-select">
                <option value="">Todos os partidos</option>
                @foreach ($partidos as $partido)
                    <option value="{{ $partido }}" {{ request('partido') == $partido ? 'selected' : '' }}>{{ $partido }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Tabela -->
    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Deputado</th>
                <th>Partido</th>
                <th>UF</th>
                <th>Despesas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($deputados as $deputado)
                <tr>
                    <td>{{ $deputado->nome }}</td>
                    <td>{{ $deputado->sigla_partido }}</td>
                    <td>{{ $deputado->sigla_uf }}</td>
                  <td>
    @if ($deputado->despesas->isEmpty())
        <em>Sem despesas</em>
    @else
        <button class="btn btn-sm btn-secondary mb-2" type="button" 
                onclick="toggleDespesas('despesas-{{ $deputado->id }}')">
            Mostrar/Ocultar despesas
        </button>
        <ul class="mb-0" id="despesas-{{ $deputado->id }}" style="display: none;">
            @foreach ($deputado->despesas as $despesa)
                <li>
                    {{ $despesa->tipo_despesa }} - 
                    R$ {{ number_format($despesa->valor_documento, 2, ',', '.') }}
                </li>
            @endforeach
        </ul>
    @endif
</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum deputado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    
 
      <div>
   {{ $deputados->withQueryString()->links() }}</div>

 
 <script>
    function toggleDespesas(id) {
        const lista = document.getElementById(id);
        if (lista.style.display === "none") {
            lista.style.display = "block";
        } else {
            lista.style.display = "none";
        }
    }
</script>
</body>
</html>
