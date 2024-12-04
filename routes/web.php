<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ProjetoController;

// Página inicial (login)
Route::get('/', [LoginController::class, 'index'])->name('login');

// Processa o login
Route::post('/login', [LoginController::class, 'validaLogin'])->name('logar');

// Processa o registro
Route::post('/registrar', [RegistroController::class, 'create'])->name('registrar');

// Página inicial do usuário autenticado
Route::get('/home', [LoginController::class, 'retornaHome'])->name('home')->middleware('auth');

// Outras rotas
Route::get('/search', function () {
    // Lógica de pesquisa
})->name('search');

Route::get('/messages', function () {
    // Página de mensagens
})->name('messages');

Route::middleware(['auth'])->group(function () {
    // Exibir todas as músicas do artista logado
    Route::get('/perfil', [PerfilController::class, 'index'])->name('profile');
});

Route::get('/perfil/{id}', [PerfilController::class, 'show'])->name('profile.show');

// Rota de logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas para músicas
Route::middleware(['auth'])->group(function () {
    // Exibe o formulário para criar uma música
    Route::get('/musicas/create', [MusicaController::class, 'create'])->name('musicas.create');

    // Salva a música no banco de dados
    Route::post('/musicas', [MusicaController::class, 'store'])->name('musicas.store');
});

Route::middleware(['auth'])->group(function () {
    // Exibir todas as músicas do artista logado
    Route::get('/musicas', [MusicaController::class, 'index'])->name('minhasMusicas');
});


Route::get('/editarPerfil', [PerfilController::class, 'viewEditar'])->name('editarPerfil'); // Exibe o formulário de edição
Route::post('/editar-perfil', [PerfilController::class, 'atualizar'])->name('edit'); // Processa a atualização do perfil

Route::get('/pesquisar/ajax', [PerfilController::class, 'pesquisarAjax'])->name('pesquisarUsuario.ajax');

Route::get('/projetos', [ProjetoController::class, 'index'])->name('projetos.index');
Route::post('/projetos', [ProjetoController::class, 'store'])->name('projetos.store');

// Rota para conectar o usuário a um projeto
Route::post('/projeto/{id}/conectar', [ProjetoController::class, 'conectar'])->name('projetos.conectar');



