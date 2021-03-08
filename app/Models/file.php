<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file extends Model
{
    use HasFactory;

    public function filesCategories(){
        return $this->belongsTo(filesCategory::class);
    }

    public function filesSubCategories(){
        return $this->belongsTo(filesSubCategory::class);
    }
}