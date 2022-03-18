<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use Illuminate\Http\Request;

class RenewalController extends Controller
{
    public function index()
    {
        $renewals = Renewal::get();
        return view('asset.renewal.index', compact('renewals'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        Renewal::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function show(Renewal $renewal)
    {
        //
    }

    public function edit(Renewal $renewal)
    {
        $renewals = Renewal::get();
        return view('asset.renewal.edit', compact('renewal', 'renewals'));
    }

    public function update(Request $request, Renewal $renewal)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = $request->all();
        $renewal->update($data);

        return redirect('/renewal')->with('success', 'Success!');
    }

    public function destroy(Renewal $renewal)
    {
        $renewal->delete();
        return redirect('/renewal')->with('success', 'Success!');
    }
}
