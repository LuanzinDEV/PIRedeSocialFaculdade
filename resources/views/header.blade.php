<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabeçalho de Rede Social</title>
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">

</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="/home" style="color: white; text-decoration: none;">ALJMusic</a>
        </div>

        <div class="search-bar" style="flex-direction: column;">
            <form class="pesquisa-form">
                <input type="text" id="search-input" placeholder="Buscar usuário..." autocomplete="off">
            </form>
            <div id="search-results" class="resultados-pesquisa"></div>
        </div>

       

        <div class="nav-links">
            <a href="{{ route('home') }}">Início</a>
            <a href="{{ route('projetos.index') }}">Conexoes</a>
            <a href="{{ route('minhasMusicas') }}">Minhas Músicas</a>
        </div>

        <div class="user-menu">
            <img src="{{ asset('storage/perfil/' . $perfil->foto_perfil) }}" alt="Avatar" class="perfil-avatar">
            <a href="{{ route('profile') }}">Meu Perfil</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-size: 1rem;">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Inclusão do JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();

                if (query.length >= 3) {
                    $.ajax({
                        url: '{{ route("pesquisarUsuario.ajax") }}',
                        method: 'GET',
                        data: { query: query },
                        success: function(response) {
                            $('#search-results').html(response).slideDown();
                        },
                        error: function() {
                            $('#search-results').html('<p>Erro ao buscar resultados.</p>').slideDown();
                        }
                    });
                } else {
                    $('#search-results').slideUp();
                }
            });

            // Esconde os resultados ao clicar fora
            $(document).on('click', function(event) {
                if (!$(event.target).closest('.search-bar').length) {
                    $('#search-results').slideUp();
                }
            });
        });
    </script>
</body>
</html>
