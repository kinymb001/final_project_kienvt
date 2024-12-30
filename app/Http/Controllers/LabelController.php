<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();
        return view('labels.index', compact('labels'));
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Label::create(['name' => $request->name]);

        return redirect()->route('labels.index')->with('success', 'Label created successfully!');
    }

    public function edit($id)
    {
        $label = Label::findOrFail($id);
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $label = Label::findOrFail($id);
        $label->update(['name' => $request->name]);

        return redirect()->route('labels.index')->with('success', 'Label updated successfully!');
    }

    public function destroy($id)
    {
        $label = Label::findOrFail($id);
        $label->delete();

        return redirect()->route('labels.index')->with('success', 'Label deleted successfully!');
    }
}
