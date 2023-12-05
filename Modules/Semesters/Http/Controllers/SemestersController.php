<?php

namespace Modules\Semesters\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Semesters\Models\Semester;

class SemestersController extends Controller
{
    public function index()
    {
        $semesters = Semester::get();

        return view('semesters::index', compact('semesters'));
    }

    public function create()
    {
        return view('semesters::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Semester::create($request->all());

        return redirect(route('app.semesters.index'));
    }

    public function edit($id)
    {
        $semester = Semester::findOrFail($id);

        return view('semesters::edit', compact('semester'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Semester::findOrFail($id)->update($request->all());

        return redirect(route('app.semesters.index'));
    }

    public function destroy($id)
    {
        Semester::findOrFail($id)->delete();

        return redirect(route('app.semesters.index'));
    }

    /**
     * Delete all selected Semester at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Semester::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
