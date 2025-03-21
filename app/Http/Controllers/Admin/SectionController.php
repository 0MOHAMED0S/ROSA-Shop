<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Exception;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::get();
        return view('Admin.Sections.AllSections', compact('sections'));
    }
    public function create()
    {
        return view('Admin.Sections.AddSection');
    }
    public function store(SectionRequest $request)
    {
        try {
            $data = $request->validated();
            Section::create($data);
            return redirect()->route('dashboard.sections.index')->with('success', 'The Sections Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(SectionRequest $request, $id)
    {
        try {
            $section = Section::findOrFail($id);
            $data = $request->validated();
            $section->update($data);
            return redirect()->back()->with('success', 'The Sections Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $section = Section::findOrFail($id);
            if ($section->products()->exists()) {
                return redirect()->back()->with('error', 'Cannot delete this section because it has associated products.');
            }
            $section->delete();
            return redirect()->back()->with('success', 'The Section Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
