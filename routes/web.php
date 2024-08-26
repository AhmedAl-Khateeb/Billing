<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;






Route::get('/', function () {
    return view('auth.login');
});

// Invoices
Route::prefix('invoices')->group(function(){
 Route::get('/',[InvoicesController::class,'index'])->name('invoices.index');
 Route::get('create',[InvoicesController::class,'create'])->name('invoices.create');
 Route::post('/invoices',[InvoicesController::class,'store'])->name('invoices.store');
 Route::get('invoices/{id}', [InvoicesController::class, 'show'])->name('invoices.show');
 Route::post('/Status_Update/{id}', [InvoicesController::class,'Status_Update'])->name('Status_Update');

 Route::get('edit',[InvoicesController::class,'edit'])->name('invoices.edit');
 Route::post('update',[InvoicesController::class,'update'])->name('invoices.update');
 Route::get('destroy/{id}',[InvoicesController::class,'destroy'])->name('invoices.delete');

 Route::get('/getProducts/{id}', [ProductsController::class, 'getProducts']);

 Route::get('MarkAsRead_all',[InvoicesController::class,'MarkAsRead_all'])->name('MarkAsRead_all');


//  InvoicesDetails Table
//  ده لعرض بيانات البنك عند الضغط عليه
Route::get('/invoices/InvoicesDetails/{id}/edit', [InvoicesDetailsController::class, 'edit'])->name('InvoicesDetails.edit');
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file'])->name('InvoicesDetails.open_file');
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file'])->name('InvoicesDetails.get_file');

Route::post('/delete_file', [InvoicesDetailsController::class, 'destroy'])->name('destroy');

Route::post('InvoiceAttachments',[InvoiceAttachmentsController::class,'InvoiceAttachments'])->name('InvoiceAttachments');

});




// Sections
Route::prefix('sections')->group(function(){
    Route::get('/',[SectionsController::class,'index'])->name('sections.index');
    Route::get('create',[SectionsController::class,'create'])->name('sections.create');
    Route::post('/sections', [SectionsController::class, 'store'])->name('sections.store');
    Route::get('/edit/{id}', [SectionsController::class, 'edit'])->name('sections.edit');
    Route::post('/update', [SectionsController::class, 'update'])->name('sections.update');
    Route::delete('destroy/{id}', [SectionsController::class, 'destroy'])->name('sections.destroy');
});  ###########  End Section

// ##############################################
// ################ Start Products #############
Route::prefix('products')->group(function(){
    Route::get('/',[ProductsController::class,'index'])->name('products.index');
    Route::get('create',[ProductsController::class,'create'])->name('products.create');
    Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::post('/update', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
});
############# End Products #####################




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{page}', [AdminController::class,'index']);


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
