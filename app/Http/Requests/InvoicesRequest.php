<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicesRequest extends FormRequest
{



    public function authorize()
    {
        return true;
    }




    public function rules()
    {
        return [
            'invoice_number' => 'required|string|max:255',
            'invoice_Data' => 'required|date',
            'due_data' => 'required|date',
            'product' => 'required|string|max:255',
            'section_id' => 'required|integer|exists:sections,id', //column id
            'Amount_collection' => 'required|numeric|min:0',
            'Amount_Commission' => 'required|numeric|min:0',
            'Discount' => 'required|numeric|min:0',
            'Value_VAT' => 'required|numeric|min:0',
            'Rate_VAT' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,paid,canceled',
            'value_status' => 'required|string|in:active,inactive',
            'note' => 'nullable|string|max:1000',
        ];
    }

}
