@extends('layout')
<head>
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">
</head>
@section('titulo', 'Home')

@section('content')   

        @if(session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="h1_musica" style="text-align: center; margin-top:20px;">Postar uma Nova Música</h1>
        <form class="form_musica" action="{{ route('musicas.store') }}" method="POST" enctype="multipart/form-data">
            <div class="content_musica">
                
                @csrf
                <div class="titulo_musica">
                    <label for="titulo">Título da Música:</label>
                    <input type="text" name="titulo" id="titulo" required>
                </div>

                <div class="genero_musica">
                    <label for="genero">Gênero:</label>
                    <select name="genero" id="genero" required>
                        <option value="Rock">Rock</option>
                        <option value="Pop">Pop</option>
                        <option value="Jazz">Jazz</option>
                        <option value="Hip-Hop">Hip-Hop</option>
                        <option value="Clássica">Clássica</option>
                        
                    </select>
                </div>

                <div class="upload_musica">
                    <label for="arquivo">Upload de Música (MP3):</label>
                    <input type="file" name="arquivo" accept=".mp3" required>
                </div>
            </div> 
            <button type="submit" class="botao_musica">Enviar Música</button>  
        </form>
   

        <div class="feed" style="padding-top: 20px; display: flex; flex-direction: column;">
            @foreach ($atividades as $atividade)
                <div class="feed_item">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <strong>{{ $atividade->usuario->nome }}</strong> <!-- Exibe o nome do usuário -->
                            </div>
                            <p class="card-description">
                                {{ $atividade->descricao }}
                            </p>
                            <span class="text-muted" style="font-size: 12px;">{{ $atividade->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        
    </div>
@endsection

