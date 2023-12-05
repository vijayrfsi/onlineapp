<?php

namespace Modules\Blogs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blogs\Models\Blog;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();

        return view('blogs::index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Blog::create($request->all());

        return redirect(route('app.blogs.index'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs::edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Blog::findOrFail($id)->update($request->all());

        return redirect(route('app.blogs.index'));
    }

    public function destroy($id)
    {
        Blog::findOrFail($id)->delete();

        return redirect(route('app.blogs.index'));
    }

    /**
     * Delete all selected Blog at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Blog::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
