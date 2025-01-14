<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sections extends Model
{
    use HasFactory;

    protected $fillable = [
      'section_name',
      'description',
      'created_by'
    ];

    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(products::class);
    }
}
