<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\sections;
use Illuminate\Http\Request;
use App\Http\Requests\productRequest;
use App\Http\Requests\updateProductRequest;

class ProductsController extends Controller
{

    public function index()
    {
        $products = products::all();
        $sections= sections::all();
        return view('Products.index',compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('Products.index');
    }


    public function store(Request $request)
    {
        try {
            $products = new products();

            $products->product_name = $request->product_name;
            $products->description = $request->description;
            $products->section_id = $request->section_id;
            $products->save();

            return redirect()->back()->with('Add', 'تم إضافة القسم بنجاح');
        } catch (\Exception $ex) {
            return redirect()->back()->with('Error', 'خطأ: القسم مسجل مسبقًا');
        }
    }



    public function show(products $products)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'product_name' => 'required|unique:products,product_name,' . $id . '|max:255',
            'description' => 'required|string',
            'section_id' => 'required|integer|exists:sections,id',
        ], [
            'product_name.required' => 'يرجى ادخال اسم القسم',
            'product_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required' => 'يرجى ادخال البيان',
            'section_id.required' => 'يرجى اختيار القسم',
            'section_id.integer' => 'معرف القسم يجب ان يكون رقم صحيح',
            'section_id.exists' => 'القسم المختار غير موجود',
        ]);

        $products = Products::find($id);
        $products->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);

        session()->flash('edit', 'تم التعديل بنجاح');
        return redirect('/products');
    }




    public function destroy($id)
    {
     products::findOrFail($id)->delete();

         session()->flash('delete','تم الحذف بنجاح');
         return redirect('/products');

    }
}
