<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->orderBy('id', 'desc')->get();
        return response()->json($comments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $request->validate([
            'comment' => 'required|min:2|max:255',
            'post_id' => 'required'
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('status', 'Debes iniciar sesión para publicar un comentario!');
        }

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;

        $comment->save();

        return redirect()->back()->with('status', 'Comentario publicado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
