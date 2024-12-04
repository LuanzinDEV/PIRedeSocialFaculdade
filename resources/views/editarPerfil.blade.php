@extends('layout')
@section('titulo', 'editar')

@section('content')
<div class="container mt-5 pt-5">
    <h3 class="text-center text-primary mb-4">Editar Dados do Usuário</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('edit') }}" method="POST" class="mt-3" enctype="multipart/form-data">

        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $perfil->nome }}">
            @foreach ($errors->get('nome', []) as $erro)
                <div class="text-danger">{{ $erro }}</div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome</label>
            <input type="text" id="sobrenome" name="sobrenome" class="form-control" value="{{ $perfil->sobrenome }}">
            @foreach ($errors->get('sobrenome', []) as $erro)
                <div class="text-danger">{{ $erro }}</div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control">{{ $perfil->descricao }}</textarea>
            @foreach ($errors->get('descricao', []) as $erro)
                <div class="text-danger">{{ $erro }}</div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="foto_perfil" class="form-label">Foto de Perfil</label>
            <input type="file" id="foto_perfil" name="foto_perfil" class="form-control">
            @foreach ($errors->get('foto_perfil', []) as $erro)
                <div class="text-danger">{{ $erro }}</div>
            @endforeach
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
@endsection
