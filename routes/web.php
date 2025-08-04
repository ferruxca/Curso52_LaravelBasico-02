<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Rutas públicas (accesibles para usuarios no logueados)
Route::middleware('guest')->group(function () {
    // Ruta para mostrar el formulario de login (GET)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // Ruta para procesar el login (POST)
    Route::post('/login', [LoginController::class, 'login']);

    // Ruta para mostrar el formulario de registro (GET)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Ruta para procesar el registro (POST)
    Route::post('/register', [RegisterController::class, 'register']);

    // Recuperación de Passwords
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Logout (cerrar sesión)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para usuarios que han iniciado sesión

Route::middleware('auth')->group(function () {

    // Ruta protegida (solo accesible para usuarios logueados)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // POST
    Route::get('post', [PostController::class, 'index'])->name('post.index');
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::get('post/show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    // COMMENTS
    Route::get('comments/{post_id}', [CommentController::class, 'index'])->name('comment.index');
    Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

    // ROLES
    // Asignar rol a un usuario
    Route::post('/users/{userId}/roles', [UserController::class, 'assignRole'])->name('users.assignRole');
    // Obtener roles de un usuario
    Route::get('/users/{userId}/roles', [UserController::class, 'getUserRoles'])->name('users.getUserRoles');
    // Eliminar rol de un usuario
    Route::delete('/users/{userId}/roles/{roleId}', [UserController::class, 'removeRole'])->name('users.removeRole');
    // Sincronizar roles
    Route::put('/users/{userId}/roles', [UserController::class, 'syncRoles'])->name('users.syncRoles');

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::get('/', function () {
    return view('welcome');
});
