<?php

namespace App\Http\Controllers\API;

use App\Models\products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\productRequest;
use App\Http\Resources\productsResource;

class apiproductsController extends Controller
{

    public function index()
{
    return productsResource::collection(products::all());
}





public function store(productRequest $request)
{

    $product = new Products();

    $product->product_name = $request->input('product_name');
    $product->description = $request->input('description');
    $product->section_id = $request->input('section_id');


    $product->save();

    return new productsResource($product);
}



    public function show($id)
    {
       $products = products::query()->findOrFail($id);

       return productsResource::make($products);
    }







    public function update(productRequest $request, $id)
{

    $product = products::find($id);

    if (!$product) {
        return response()->json([
            'message' => 'Product not found.'
        ], 404);
    }

    $product->update($request->validated());

    return new productsResource($product);
}



public function destroy($id)
{

    $product = products::find($id);


    if (!$product) {
        return response()->json([
            'message' => 'Product not found.'
        ], 404);
    }

    $product->delete();

    return response()->json([
        'message' => 'Product deleted successfully.'
    ], 200);
}

}
