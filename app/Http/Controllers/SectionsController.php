<?php

namespace App\Http\Controllers;
use App\Models\Sections;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\sectionRequest;

class SectionsController extends Controller
{

    public function index()
    {


        $sections = Sections::all();

        return view('Sections.index', compact('sections'));
    }


    public function create()
    {

    }


    public function store(sectionRequest $request)
    {


      $sectionExists = Sections::where('section_name', $request->section_name)->exists();

    if ($sectionExists) {
    session()->flash('Error', 'خطأ: القسم مسجل مسبقًا');
    return redirect('/sections');
     } else {
    Sections::create([
        'section_name' => $request->section_name,
        'description' => $request->description,
        'created_by' => Auth::user()->name,
    ]);

    session()->flash('Add', 'تم إضافة القسم بنجاح');
    return redirect('/sections');
}


    }


    public function show(sections $sections)
    {
        //
    }


    public function edit($id)
    {
        $sections = Sections::find($id);
        return view('Sections.edit',compact('sections'));
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request,[

                'section_name' => 'required|unique:sections,section_name|max:255,'.$id,
                'description' => 'required|string',
            ],
            [
              'section_name.required'=>'يرجى ادخال اسم القسم',
              'section_name.unique'=>'اسم القسم مسجل مسبقا',
              'description.required'=>'يرجى ادخال البيان'

        ]);
        $sections = Sections::find($id);
        $sections->update([
          'section_name' => $request->section_name,
          'description' => $request->description,
        ]);

        session()->flash('edit','تم التعديل بنجاح');
        return redirect('/sections');
    }


    public function destroy($id)
    {
        Sections::findOrFail($id)->delete();
        session()->flash('delete', 'تم الحذف بنجاح');
        return redirect('/sections');
    }

}
