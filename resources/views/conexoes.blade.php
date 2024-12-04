@extends('layout')
@section('titulo', 'Conexões e Colaborações')

@section('content')
<div class="conexoes-container">
    <h1 class="titulo-conexoes">Conexões e Colaborações</h1>

    <!-- Mensagem de Sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="projetos-container">
        <h2 class="subtitulo">Projetos Colaborativos</h2>

        <div class="projetos-list">
            @forelse($projetos as $projeto)
                <div class="projeto-card">
                    <div class="projeto-info">
                        <strong>{{ $projeto->nome }}</strong>
                        <p>{{ $projeto->descricao }}</p>
                        <p class="projeto-membros">
                            <strong>Membros:</strong>
                            @if($projeto->membros->isNotEmpty())
                                {{-- Exibe os nomes dos membros --}}
                                {{ $projeto->membros->pluck('nome')->implode(', ') }}
                            @else
                                Sem membros
                            @endif
                        </p>
                    </div>
                    <div class="projeto-actions">
                        {{-- Verifica se o usuário já é membro do projeto --}}
                        @if($projeto->membros->contains('id', $usuarioId))
                            <p>Você já pertence a este projeto!</p>
                        @else
                            <form action="{{ route('projetos.conectar', $projeto->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="botao-projeto">Conectar ao Projeto</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p>Não há projetos disponíveis no momento.</p>
            @endforelse
        </div>

        <div class="criar-projeto">
            <h2 class="subtitulo">Criar Novo Projeto</h2>
            <form action="{{ route('projetos.store') }}" method="POST" class="form-criar-projeto">
                @csrf
                <input type="text" name="nome" placeholder="Nome do projeto" required class="input-criar">
                <textarea name="descricao" placeholder="Descrição do projeto" required class="input-criar"></textarea>
                <button type="submit" class="botao-criar">Criar Projeto</button>
            </form>
        </div>
    </div>
</div>
@endsection
