<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Posts\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('posts::index', compact('posts'));
    }

    public function create()
    {
        return view('posts::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Post::create($request->all());

        return redirect(route('app.posts.index'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts::edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Post::findOrFail($id)->update($request->all());

        return redirect(route('app.posts.index'));
    }

    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return redirect(route('app.posts.index'));
    }
}
