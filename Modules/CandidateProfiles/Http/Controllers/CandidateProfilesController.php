<?php

namespace Modules\CandidateProfiles\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CandidateProfiles\Models\CandidateProfile;

class CandidateProfilesController extends Controller
{
    public function index()
    {
        $candidate_profiles = CandidateProfile::get();

        return view('candidate_profiles::index', compact('candidate_profiles'));
    }

    public function create()
    {
        return view('candidate_profiles::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        CandidateProfile::create($request->all());

        return redirect(route('app.candidate_profiles.index'));
    }

    public function edit($id)
    {
        $candidateprofile = CandidateProfile::findOrFail($id);

        return view('candidate_profiles::edit', compact('candidateprofile'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        CandidateProfile::findOrFail($id)->update($request->all());

        return redirect(route('app.candidate_profiles.index'));
    }

    public function destroy($id)
    {
        CandidateProfile::findOrFail($id)->delete();

        return redirect(route('app.candidate_profiles.index'));
    }

    /**
     * Delete all selected CandidateProfile at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        CandidateProfile::whereIn('id', request('ids'))->delete();

        return response()->noContent();
    }

}
