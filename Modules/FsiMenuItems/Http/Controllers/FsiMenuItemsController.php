<?php

namespace Modules\FsiMenuItems\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FsiMenuItems\Models\FsiMenuItem;

class FsiMenuItemsController extends Controller
{
    public function index()
    {
        $fsi_menu_items = FsiMenuItem::get();

        return view('fsi_menu_items::index', compact('fsi_menu_items'));
    }

    public function create()
    {
        return view('fsi_menu_items::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        FsiMenuItem::create($request->all());

        return redirect(route('app.fsi_menu_items.index'));
    }

    public function edit($id)
    {
        $fsimenuitem = FsiMenuItem::findOrFail($id);

        return view('fsi_menu_items::edit', compact('fsimenuitem'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        FsiMenuItem::findOrFail($id)->update($request->all());

        return redirect(route('app.fsi_menu_items.index'));
    }

    public function destroy($id)
    {
        FsiMenuItem::findOrFail($id)->delete();

        return redirect(route('app.fsi_menu_items.index'));
    }
}
