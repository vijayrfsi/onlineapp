<?php

namespace Modules\Classes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Classes\Models\Class;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Class::get();

        return view('classes::index', compact('classes'));
    }

    public function create()
    {
        return view('classes::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Class::create($request->all());

        return redirect(route('app.classes.index'));
    }

    public function edit($id)
    {
        $class = Class::findOrFail($id);

        return view('classes::edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Class::findOrFail($id)->update($request->all());

        return redirect(route('app.classes.index'));
    }

    public function destroy($id)
    {
        Class::findOrFail($id)->delete();

        return redirect(route('app.classes.index'));
    }

    /**
     * Delete all selected Class at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Class::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
