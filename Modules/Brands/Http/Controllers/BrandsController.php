<?php

namespace Modules\Brands\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Brands\Models\Brand;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::get();

        return view('brands::index', compact('brands'));
    }

    public function create()
    {
        return view('brands::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Brand::create($request->all());

        return redirect(route('app.brands.index'));
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('brands::edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        Brand::findOrFail($id)->update($request->all());

        return redirect(route('app.brands.index'));
    }

    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();

        return redirect(route('app.brands.index'));
    }

    /**
     * Delete all selected Brand at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        Brand::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
