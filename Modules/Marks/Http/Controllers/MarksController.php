<?php

namespace Modules\Marks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Marks\Models\Mark;

class MarksController extends Controller
{
    public function index()
    {
        $marks = Mark::get();

        return view('marks::index', compact('marks'));
    }

    public function create()
    {
        return view('marks::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Mark::create($request->all());

        return redirect(route('app.marks.index'));
    }

    public function edit($id)
    {
        $mark = Mark::findOrFail($id);

        return view('marks::edit', compact('mark'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Mark::findOrFail($id)->update($request->all());

        return redirect(route('app.marks.index'));
    }

    public function destroy($id)
    {
        Mark::findOrFail($id)->delete();

        return redirect(route('app.marks.index'));
    }

    /**
     * Delete all selected Mark at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Mark::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
