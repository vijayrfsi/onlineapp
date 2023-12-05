<?php

namespace Modules\Departments\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Departments\Models\Department;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::get();

        return view('departments::index', compact('departments'));
    }

    public function create()
    {
        return view('departments::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Department::create($request->all());

        return redirect(route('app.departments.index'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('departments::edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Department::findOrFail($id)->update($request->all());

        return redirect(route('app.departments.index'));
    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();

        return redirect(route('app.departments.index'));
    }

    /**
     * Delete all selected Department at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Department::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
