<?php

namespace Modules\FsiMenus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FsiMenus\Models\FsiMenu;

class FsiMenusController extends Controller
{
    public function index()
    {
        $fsi_menus = FsiMenu::get();

        return view('fsi_menus::index', compact('fsi_menus'));
    }

    public function create()
    {
        return view('fsi_menus::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        FsiMenu::create($request->all());

        return redirect(route('app.fsi_menus.index'));
    }

    public function edit($id)
    {
        $fsimenu = FsiMenu::findOrFail($id);

        return view('fsi_menus::edit', compact('fsimenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        FsiMenu::findOrFail($id)->update($request->all());

        return redirect(route('app.fsi_menus.index'));
    }

    public function destroy($id)
    {
        FsiMenu::findOrFail($id)->delete();

        return redirect(route('app.fsi_menus.index'));
    }
}
