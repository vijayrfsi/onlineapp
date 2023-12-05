<?php

namespace Modules\Districts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Districts\Models\District;

class DistrictsController extends Controller
{
    public function index()
    {
        $districts = District::get();

        return view('districts::index', compact('districts'));
    }

    public function create()
    {
        return view('districts::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        District::create($request->all());

        return redirect(route('app.districts.index'));
    }

    public function edit($id)
    {
        $district = District::findOrFail($id);

        return view('districts::edit', compact('district'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        District::findOrFail($id)->update($request->all());

        return redirect(route('app.districts.index'));
    }

    public function destroy($id)
    {
        District::findOrFail($id)->delete();

        return redirect(route('app.districts.index'));
    }

    /**
     * Delete all selected District at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        District::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
