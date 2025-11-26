@extends('layouts.app')

@section('title', 'Listar Categorias')

@section('content')
<div class="page-header">
    <h2>Categorias</h2>
    <a href="{{ url('/categorias/create') }}" class="btn btn-success">+ Nova Categoria</a>
</div>

<div class="card">
    @if($categorias->isEmpty())
        <div class="empty-state">
            <p>Nenhuma categoria cadastrada.</p>
            <a href="{{ route('categorias.create') }}" class="btn btn-primary">Criar primeira categoria</a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>#{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->descricao ? substr($categoria->descricao, 0, 50) . (strlen($categoria->descricao) > 50 ? '...' : '') : '-' }}</td>
                    <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ url('/categorias/' . $categoria->id . '/edit') }}" class="btn btn-warning">Editar</a>
                            <form action="{{ url('/categorias/' . $categoria->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
