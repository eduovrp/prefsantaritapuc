<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'year',
        'file_category_id',
        'file_sub_category_id'
    ];

    public function fileCategories(){
        return $this->belongsTo(FileCategory::class);
    }

    public function fileSubCategories(){
        return $this->belongsTo(FileSubCategory::class);
    }
}
