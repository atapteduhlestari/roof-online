<?php

namespace App\Http\Controllers;

use App\Models\SBU;
use Illuminate\Http\Request;
use App\Rules\SpecialCharacter;

class SBUController extends Controller
{
    public function index()
    {
        $sbus = SBU::orderBy('sbu_name', 'asc')->get();
        return view('asset.sbu.index', compact('sbus'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'sbu_name' => ['required', new SpecialCharacter],
        ]);

        $data = $request->all();

        SBU::create($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function show(SBU $sbu)
    {
        //
    }

    public function edit(SBU $sbu)
    {
        return view('asset.sbu.edit', compact('sbu'));
    }

    function update(Request $request, SBU $sbu)
    {
        $request->validate([
            'sbu_name' => ['required', new SpecialCharacter],
        ]);

        $data = $request->all();

        $sbu->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(SBU $sbu)
    {
        if ($sbu->assets()->exists()) {
            return redirect('/sbu')->with('warning', 'Cannot delete sbu that have assets!');
        }

        if ($sbu->docs()->exists()) {
            return redirect('/sbu')->with('warning', 'Cannot delete sbu that have docs!');
        }

        $sbu->delete();
        return redirect()->back()->with('success', 'Success!');
    }
}
