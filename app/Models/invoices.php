<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function section()
{
    return $this->belongsTo(Sections::class, 'section_id');
}

}
