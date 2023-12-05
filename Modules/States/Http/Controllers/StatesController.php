<?php

namespace Modules\States\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\States\Models\State;

class StatesController extends Controller
{
    public function index()
    {
        $states = State::get();

        return view('states::index', compact('states'));
    }

    public function create()
    {
        return view('states::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        State::create($request->all());

        return redirect(route('app.states.index'));
    }

    public function edit($id)
    {
        $state = State::findOrFail($id);

        return view('states::edit', compact('state'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        State::findOrFail($id)->update($request->all());

        return redirect(route('app.states.index'));
    }

    public function destroy($id)
    {
        State::findOrFail($id)->delete();

        return redirect(route('app.states.index'));
    }

    /**
     * Delete all selected State at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        State::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
