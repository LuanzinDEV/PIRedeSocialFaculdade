@if($usuarios->isEmpty())
    <p style="padding: 10px; text-align: center;">Nenhum usuário encontrado.</p>
@else
    @foreach ($usuarios as $usuario)
        <div class="resultado-card" style="background-color: white; margin: 20px; padding: 10px; border: black 2px solid; color: black">
            <img src="{{ asset('storage/perfil/' . $usuario->foto_perfil) }}" alt="Avatar" class="resultado-avatar" style="max-height: 50px; height:50px; max-width:50px; width:50px;">
            <div class="resultado-info">
                <p>{{ $usuario->email }}</p>
                <a href="{{ route('profile.show', ['id' => $usuario->id]) }}" class="ver-perfil">Ver Perfil</a>
            </div>
        </div>
    @endforeach
@endif
