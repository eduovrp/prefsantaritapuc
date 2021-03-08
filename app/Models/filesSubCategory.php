<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filesSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iconMenu',
        'file_category_id'
    ];

    public function filesCategories(){
        return $this->belongsTo(filesCategory::class);
    }
}
