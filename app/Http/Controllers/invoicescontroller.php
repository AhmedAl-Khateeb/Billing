<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\invoices;
use App\Models\products;
use App\Models\Sections;
use App\Models\invoices_details;
use App\Models\invoice_attachments;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AddInvoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Events\MyEventClass;

class invoicescontroller extends Controller
{
    public function index(){

        $invoices = invoices::all();
        return view('invoices.index',compact('invoices'));
    }

    public function create(){
        $sections = Sections::all();
        $products = products::all();
        return view('Invoices.create',compact('sections','products'));
    }


    public function store(Request $request)
{
    $total = $request->total ?? 0;

    $section = Sections::find($request->Section);
if (!$section) {
    return back()->withErrors(['error' => 'The selected section does not exist.']);
}


    invoices::create([
        'invoice_number' => $request->invoice_number,
        'invoice_Data' => $request->invoice_Data,
        'due_data' => $request->due_data,
        'product' => $request->product,
        'section_id' => $request->Section,
        'Amount_collection' => $request->Amount_collection,
        'Amount_Commission' => $request->Amount_Commission,
        'Discount' => $request->Discount,
        'Value_VAT' => $request->Value_VAT,
        'Rate_VAT' => $request->Rate_VAT,
        'total' => $request->total,
        'status' => 'غير مدفوعة',
        'value_status' => 2,
        'note' => $request->note,
    ]);

    $invoice_id = invoices::latest()->first()->id;
    invoices_details::create([
        'id_Invoice' => $invoice_id,
        'invoice_number' => $request->invoice_number,
        'product' => $request->product,
        'Section' => $request->Section,
        'Status' => 'غير مدفوعة',
        'Value_Status' => 2,
        'note' => $request->note,
        'user' => (Auth::user()->name),
    ]);

    if ($request->hasFile('pic')) {
        $invoice_id = invoices::latest()->first()->id;
        $image = $request->file('pic');
        $file_name = $image->getClientOriginalName();
        $invoice_number = $request->invoice_number;

        $attachments = new invoice_attachments();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $invoice_number;
        $attachments->Created_by = Auth::user()->name;
        $attachments->invoice_id = $invoice_id;
        $attachments->save();

        // move pic
        $imageName = $request->pic->getClientOriginalName();
        $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
    }


    // Notification
    $user = User::get();
    $invoices = invoices::latest()->first();
    Notification::send($user, new \App\Notifications\InvoicePaid($invoices));

    event(new MyEventClass('hello world'));

    session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
    return redirect()->route('invoices.index')->with('Add', 'تم اضافة الفاتورة بنجاح');
}


public function show($id){
    $invoices = invoices::where('id', $id)->first();
    return view('invoices.status_update', compact('invoices'));
}


    public function edit($id){

    }


    public function update($id){

    }

    public function destroy($id){

    }

    public function getProducts($id){
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }


    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }

}
