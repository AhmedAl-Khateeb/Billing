<?php

namespace App\Http\Controllers\API;

use App\Models\Sections;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\sectionRequest;
use App\Http\Resources\sectionResource;

class apisectionController extends Controller
{

    public function index()
    {
        return sectionResource::collaction(Sections::all());
    }


    public function store(sectionRequest $request)
    {
         $section = new Sections();

         $section->section_name = $request->input('section_name');
         $section->	description = $request->input('	description');
         $section->created_by = $request->input('created_by');
         $section->save();

         return new sectionResource($section);

    }


    public function show($id)
    {
        $section = Sections::query()->findOrFail($id);

        return sectionResource::make($section);
    }


    public function update(sectionRequest $request, $id)
    {
        $section = Sections::find($id);

        if (!$section) {
            return response()->json([
                'message' => 'section not found.'
            ], 404);
        }

        $section->update($request->validated());

        return new sectionResource($section);
    }


    public function destroy($id)
    {

        $section = Sections::find($id);

        // التحقق من وجود المنتج
        if (!$section) {
            return response()->json([
                'message' => 'Section not found.'
            ], 404);
        }


        $section->delete();


        return new sectionResource($section, [
            'message' => 'Section deleted successfully.'
        ]);
    }

}
