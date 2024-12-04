<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ url('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/minhasMusicas.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/conexoes.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/perfil.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/editarUser.css') }}">
</head>
<body>
    <!-- Inclui o cabeçalho -->
    @include('header')

    <!-- Conteúdo da página -->
    <main>
        @yield('content')
    </main>
</body>
</html>
