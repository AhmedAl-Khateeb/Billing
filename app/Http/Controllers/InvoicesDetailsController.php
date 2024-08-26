<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\invoices;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Attachment; // Assuming you have a model named Attachment



use File;

class InvoicesDetailsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }



        public function show($id)
{
    $invoices = invoices::find($id);
    $attachments = $invoices->attachments;

    return view('your_view_name', compact('invoices', 'attachments'));
}




    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details = invoices_details::where('id_Invoice',$id)->get();
        $attachments = invoice_attachments::where('invoice_id',$id)->get();
        return view('Invoices.InvoicesDetails',compact('invoices','details','attachments'));
    }


    public function update(Request $request, invoices_details $invoices_details)
    {

    }



    public function destroy(Request $request)
    {
        $invoices = invoice_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }




    public function open_file($invoice_number, $file_name)
{

    $filePath = $invoice_number . '/' . $file_name;


    if (Storage::disk('public_uploads')->exists($filePath)) {

        $file = Storage::disk('public_uploads')->path($filePath);

        return response()->file($file);
    } else {

        return abort(404, 'File not found');
    }
}





    public function get_file($invoice_number,$file_name)
    {

        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
        return response()->file($files);
    }
}
