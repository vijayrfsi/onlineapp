<?php

namespace Modules\Students\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Students\Models\Student;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::get();

        return view('students::index', compact('students'));
    }

    public function create()
    {
        return view('students::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Student::create($request->all());

        return redirect(route('app.students.index'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return view('students::edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Student::findOrFail($id)->update($request->all());

        return redirect(route('app.students.index'));
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return redirect(route('app.students.index'));
    }

    /**
     * Delete all selected Student at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Student::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
