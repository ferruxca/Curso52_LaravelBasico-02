<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('home.index', compact('posts'));
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('home.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
