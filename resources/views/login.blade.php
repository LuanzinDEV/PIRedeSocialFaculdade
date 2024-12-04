<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Bem vindo!</h2>
                <p class="description description-primary">Mantenha-se organizado conosco</p>
                <button id="signin" class="btn btn-primary">Sign in</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Crie sua conta</h2>
                <p class="description description-second">Use seu e-mail para registro</p>
                <form class="form" action="{{ route('registrar') }}" method="POST">
                    @csrf
                    <label class="label-input" for="nome">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Nome">
                    </label>
                    @error('nome')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <label class="label-input" for="sobrenome">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" id="sobrenome" name="sobrenome" value="{{ old('sobrenome') }}" placeholder="Sobrenome">
                    </label>
                    @error('sobrenome')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <label class="label-input" for="email_registro">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" id="email_registro" name="email" value="{{ old('email') }}" placeholder="Email">
                    </label>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <label class="label-input" for="senha_registro">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" id="senha_registro" name="senha" placeholder="Senha" autocomplete="off">
                    </label>
                    @error('senha')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <label class="label-input" for="senha_confirmation">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" id="senha_confirmation" name="senha_confirmation" placeholder="Confirme sua senha" autocomplete="off">
                    </label>
                    <button class="btn btn-second">Registrar</button>
                </form>
            </div>
        </div>

        <div class="content second-content">
            <div class="first-column">
                <h2 class="title title-primary">Olá!</h2>
                <p class="description description-primary">Registre-se</p>
                <p class="description description-primary">e conecte-se conosco</p>
                <button id="signup" class="btn btn-primary">Registre</button>
            </div>
            <div class="second-column">
                <h2 class="title title-second">Login</h2>
                <p class="description description-second">Use seu e-mail para acesso</p>
                <form class="form" action="{{ route('logar') }}" method="POST">
                    @csrf
                    <label class="label-input" for="email_login">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" id="email_login" name="email" placeholder="Email">
                    </label>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <label class="label-input" for="senha_login">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" id="senha_login" name="senha" placeholder="Senha" autocomplete="off">
                    </label>
                    @error('senha')
                        <span class="error">{{ $message }}</span>
                    @enderror
                    <button class="btn btn-second">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/js/login.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Erro(s) encontrado(s):',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>
</html>
