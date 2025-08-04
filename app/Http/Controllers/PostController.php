<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\SavePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index()
    {
        // Verificar si el usuario tiene el rol de editor
        if (!auth()->user()->hasRole('editor')) {
            return redirect()->route('dashboard')->with('error', 'No tienes permiso para ver el listado de posts');
        }
        // Obtener todos los post
        $posts = Post::get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Verificar si el usuario tiene el rol de editor
        if (!auth()->user()->hasRole('editor')) {
            return redirect()->route('post.index')->with('error', 'No tienes permiso para crear posts');
        }

        $post = new Post(); // Al usar un formulario reutilizable para crear y editar, necesitamos un objeto vacío para crear un nuevo post.

        return view('posts.create', compact('post'));
    }

    public function store(SavePostRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        Post::create($validatedData);

        return redirect()->route('post.index')->with('status', 'Post creado correctamente!');
    }

    public function show($id)
    {
        // Muestra un registro
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Verificar si el usuario tiene el rol de editor
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('post.index')->with('error', 'No tienes permiso para editar este posts, no eres el autor');
        }
        // Muestra un registro
        return view('posts.edit', compact('post'));
    }

    public function update(SavePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $validatedData = $request->validated();
        $post->update($validatedData);

        return redirect()->route('post.index')->with('status', 'Post actualizado correctamente!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Verificar si el usuario tiene el rol de editor
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('post.index')->with('error', 'No tienes permiso para eliminar este posts, no eres el autor');
        }

        $post->delete();
        return redirect()->route('post.index')->with('status', 'Post eliminado correctamente!');
    }
}
