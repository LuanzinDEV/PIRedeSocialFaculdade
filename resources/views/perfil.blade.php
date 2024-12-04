@extends('layout')
@section('titulo', 'Perfil do Usuário')

@section('content')
<div class="perfil-container">
    <div class="perfil-header">
        <div class="perfil-info">
            <!-- Foto de perfil com fallback -->
            <img src="{{ asset('storage/perfil/' . $perfil->foto_perfil) }}" alt="Avatar" class="perfil-avatar">
            <div class="perfil-detalhes">
                <h1 class="perfil-nome">{{ $perfil->nome }} {{ $perfil->sobrenome }}</h1>
                <p class="perfil-email">{{ $perfil->email }}</p>
                <p class="perfil-sobre">{{ $perfil->descricao ?? 'Sem descrição disponível.' }}</p>
            </div>
        </div>
        <button class="btn-editar" onclick="window.location.href='{{ route('editarPerfil') }}'">Editar Perfil</button>
    </div>

    <div class="perfil-section">
        <h2 class="secao-titulo">Minhas Músicas</h2>
        <div class="musicas-container">
            @forelse($musicas as $musica)
                <div class="musica-card">
                    <div class="musica-info">
                        <strong>{{ $musica->titulo }}</strong>
                        <p>{{ $musica->genero }} - 
                            <span class="musica-data">{{ \Carbon\Carbon::parse($musica->data_upload)->format('d/m/Y') }}</span>
                        </p>
                    </div>
                    <div class="musica-audio">
                        <audio controls>
                            <source src="{{ asset('storage/' . $musica->arquivo) }}" type="audio/mp3">
                            Seu navegador não suporta o elemento de áudio.
                        </audio>
                    </div>
                </div>
            @empty
                <p class="nenhuma-musica">Nenhuma música cadastrada.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
