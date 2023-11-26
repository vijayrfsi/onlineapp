<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreFsiTableRequest;
use App\Http\Requests\Admin\UpdateFsiTableRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\FsiTable;

class FsiTablesController extends Controller
{
    /**
     * Display a listing of fsi_tables.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $fsi_tables = FsiTable::all();

        return view('admin.fsi_tables.index', compact('fsi_tables'));
    }

    /**
     * Show the form for creating new FsiTable.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        return view('admin.fsi_tables.create');
    }

    /**
     * Store a newly created FsiTable in storage.
     *
     * @param  \App\Http\Requests\Storefsi_tablesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFsiTableRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        FsiTable::create($request->all());

        return redirect()->route('admin.fsi_tables.index');
    }


    /**
     * Show the form for editing FsiTable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $FsiTable = FsiTable::findOrFail($id);

        return view('admin.fsi_tables.edit', compact('FsiTable'));
    }

    /**
     * Update FsiTable in storage.
     *
     * @param  \App\Http\Requests\Updatefsi_tablesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFsiTableRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $FsiTable = FsiTable::findOrFail($id);
        $FsiTable->update($request->all());

        return redirect()->route('admin.fsi_tables.index');
    }

    public function show(FsiTable $FsiTable)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('admin.fsi_tables.show', compact('FsiTable'));
    }

    /**
     * Remove FsiTable from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $FsiTable = FsiTable::findOrFail($id);
        $FsiTable->delete();

        return redirect()->route('admin.fsi_tables.index');
    }

    /**
     * Delete all selected FsiTable at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        FsiTable::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
