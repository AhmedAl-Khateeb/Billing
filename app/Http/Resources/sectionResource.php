<?php

namespace App\Http\Resources;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class sectionResource extends JsonResource
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
         'id'=>$this->id,
         'section_name'=>$this->section_name,
         'description'=>$this->description,
         'created_by'=>$this->created_by,
         'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
         'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
         'message' => isset($this->resource['message']) ? $this->resource['message'] : null,

        ];
    }
}
