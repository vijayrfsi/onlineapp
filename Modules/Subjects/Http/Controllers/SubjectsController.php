<?php

namespace Modules\Subjects\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Subjects\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();

        return view('subjects::index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Subject::create($request->all());

        return redirect(route('app.subjects.index'));
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);

        return view('subjects::edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Subject::findOrFail($id)->update($request->all());

        return redirect(route('app.subjects.index'));
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();

        return redirect(route('app.subjects.index'));
    }

    /**
     * Delete all selected Subject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Subject::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
