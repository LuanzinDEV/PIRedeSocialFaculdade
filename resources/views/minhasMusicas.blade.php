@extends('layout')
@section('titulo', 'Minhas Músicas')

@section('content')
<div class="container">
    <h3 class="text-center mb-4">Minhas Músicas</h3>

    @if($musicas->isEmpty())
        <p>Você ainda não tem músicas.</p>
    @else
        <div class="row">
            @foreach ($musicas as $musica)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $musica->titulo }}</h5>
                            <p class="card-text">{{ $musica->descricao }}</p>
                            <audio controls>
                                <source src="{{ asset('storage/'.$musica->arquivo) }}" type="audio/mp3">
                                Seu navegador não suporta o elemento <code>audio</code>.
                            </audio>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
