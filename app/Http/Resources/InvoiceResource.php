<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);

        return [
         'invoice_number'=>$this->invoice_number,
         'invoice_Data'=>$this->invoice_Data,
         'due_data'=>$this->due_data,
         'product'=>$this->product,
         'section_id'=>$this->section_id,
         'Amount_collection'=>$this->Amount_collection,
         'Amount_Commission'=>$this->Amount_Commission,
         'Discount'=>$this->Discount,
         'Value_VAT'=>$this->Value_VAT,
         'Rate_VAT'=>$this->Rate_VAT,
         'total'=>$this->total,
         'status'=>$this->status,
         'value_status'=>$this->value_status,
         'note'=>$this->note,
        ];
    }
}
