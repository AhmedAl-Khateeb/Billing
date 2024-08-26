<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
        [
            'section_name' => 'required|unique:sections|max:255',
            'description' => 'required|string',
        ];
        [
          'section_name.required'=>'يرجى ادخال اسم القسم',
          'section_name.unique'=>'اسم القسم مسجل مسبقا',
          'description.required'=>'يرجى ادخال البيان'
        ];
    }
}
