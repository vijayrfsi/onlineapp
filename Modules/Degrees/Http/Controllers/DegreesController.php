<?php

namespace Modules\Degrees\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Degrees\Models\Degree;

class DegreesController extends Controller
{
    public function index()
    {
        $degrees = Degree::get();

        return view('degrees::index', compact('degrees'));
    }

    public function create()
    {
        return view('degrees::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Degree::create($request->all());

        return redirect(route('app.degrees.index'));
    }

    public function edit($id)
    {
        $degree = Degree::findOrFail($id);

        return view('degrees::edit', compact('degree'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Degree::findOrFail($id)->update($request->all());

        return redirect(route('app.degrees.index'));
    }

    public function destroy($id)
    {
        Degree::findOrFail($id)->delete();

        return redirect(route('app.degrees.index'));
    }

    /**
     * Delete all selected Degree at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Degree::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
