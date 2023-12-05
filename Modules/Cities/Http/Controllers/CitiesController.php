<?php

namespace Modules\Cities\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cities\Models\City;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::get();

        return view('cities::index', compact('cities'));
    }

    public function create()
    {
        return view('cities::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        City::create($request->all());

        return redirect(route('app.cities.index'));
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);

        return view('cities::edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        City::findOrFail($id)->update($request->all());

        return redirect(route('app.cities.index'));
    }

    public function destroy($id)
    {
        City::findOrFail($id)->delete();

        return redirect(route('app.cities.index'));
    }

    /**
     * Delete all selected City at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        City::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
