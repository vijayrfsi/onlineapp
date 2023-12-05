<?php

namespace Modules\Makes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Makes\Models\Make;

class MakesController extends Controller
{
    public function index()
    {
        $makes = Make::get();

        return view('makes::index', compact('makes'));
    }

    public function create()
    {
        return view('makes::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Make::create($request->all());

        return redirect(route('app.makes.index'));
    }

    public function edit($id)
    {
        $make = Make::findOrFail($id);

        return view('makes::edit', compact('make'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Make::findOrFail($id)->update($request->all());

        return redirect(route('app.makes.index'));
    }

    public function destroy($id)
    {
        Make::findOrFail($id)->delete();

        return redirect(route('app.makes.index'));
    }

    /**
     * Delete all selected Make at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Make::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
