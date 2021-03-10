<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function filesCategories(){
        return $this->belongsTo(FileCategory::class);
    }

    public function filesSubCategories(){
        return $this->belongsTo(FileSubCategory::class);
    }
}
