@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
<div class="page-header">
    <h2>Criar Nova Categoria</h2>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
</div>

<div class="card">
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="nome">Nome da Categoria *</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Digite o nome da categoria" required>
            @if ($errors->has('nome'))
                <div class="error-message">{{ $errors->first('nome') }}</div>
            @endif
        </div>
        
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" placeholder="Digite uma descrição (opcional)">{{ old('descricao') }}</textarea>
            @if ($errors->has('descricao'))
                <div class="error-message">{{ $errors->first('descricao') }}</div>
            @endif
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Criar Categoria</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
