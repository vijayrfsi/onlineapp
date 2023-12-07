<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreFsiTableFieldRequest;
use App\Http\Requests\Admin\UpdateFsiTableFieldRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\FsiTableField;

class FsiTableFieldsController extends Controller
{
    /**
     * Display a listing of fsi_table_fields.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $fsi_table_fields = FsiTableField::all();

        return view('admin.fsi_table_fields.index', compact('fsi_table_fields'));
    }

    /**
     * Show the form for creating new FsiTableField.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        return view('admin.fsi_table_fields.create');
    }

    /**
     * Store a newly created FsiTableField in storage.
     *
     * @param  \App\Http\Requests\Storefsi_table_fieldsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFsiTableFieldRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        FsiTableField::create($request->all());

        return redirect()->route('admin.fsi_table_fields.index');
    }


    /**
     * Show the form for editing FsiTableField.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $fsi_table = FsiTableField::findOrFail($id);

        return view('admin.fsi_table_fields.edit', compact('fsi_table'));
    }

    /**
     * Update FsiTableField in storage.
     *
     * @param  \App\Http\Requests\Updatefsi_table_fieldsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFsiTableFieldRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $FsiTableField = FsiTableField::findOrFail($id);
        $FsiTableField->update($request->all());

        return redirect()->route('admin.fsi_table_fields.index');
    }

    public function show(FsiTableField $fsiTableField)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('admin.fsi_table_fields.show', compact('fsiTableField'));
    }

    /**
     * Remove FsiTableField from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $FsiTableField = FsiTableField::findOrFail($id);
        $FsiTableField->delete();

        return redirect()->route('admin.fsi_table_fields.index');
    }

    /**
     * Delete all selected FsiTableField at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        FsiTableField::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
