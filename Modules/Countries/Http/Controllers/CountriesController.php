<?php

namespace Modules\Countries\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Countries\Models\Country;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::get();

        return view('countries::index', compact('countries'));
    }

    public function create()
    {
        return view('countries::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Country::create($request->all());

        return redirect(route('app.countries.index'));
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);

        return view('countries::edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Country::findOrFail($id)->update($request->all());

        return redirect(route('app.countries.index'));
    }

    public function destroy($id)
    {
        Country::findOrFail($id)->delete();

        return redirect(route('app.countries.index'));
    }

    /**
     * Delete all selected Country at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Country::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
