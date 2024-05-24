<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DocumentGroup;
use App\Rules\SpecialCharacter;

class DocumentGroupController extends Controller
{

    public function index()
    {
        $documentGroup = DocumentGroup::get();
        return view('asset.group.document.index', compact('documentGroup'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'document_group_name' => ['required', new SpecialCharacter]
        ]);

        $data = $request->all();
        DocumentGroup::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function show(DocumentGroup $documentGroup)
    {
        //
    }

    public function edit(DocumentGroup $documentGroup)
    {
        $document_group = DocumentGroup::where('id', '!=', $documentGroup->id)->get();
        return view('asset.group.document.edit', compact('documentGroup', 'document_group'));
    }

    public function update(Request $request, DocumentGroup $documentGroup)
    {
        //
    }

    public function destroy(DocumentGroup $documentGroup)
    {
        if ($documentGroup->documents()->exists())
            return redirect('/document-group')->with('warning', 'Cannot delete group that have documents!');

        $documentGroup->delete();
        return redirect('/document-group')->with('success', 'Success!');
    }
}
