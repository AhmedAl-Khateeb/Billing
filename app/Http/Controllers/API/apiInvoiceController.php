<?php

namespace App\Http\Controllers\API;

use App\Models\invoices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoicesRequest;
use App\Http\Resources\InvoiceResource;

class apiInvoiceController extends Controller
{

    public function index()
    {
        return InvoiceResource::collaction(invoices::all());
    }





    public function store(InvoicesRequest $request)
    {
        $invoices = new invoices();
    }


    public function show($id)
    {
        //
    }


    public function update(InvoicesRequest $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
