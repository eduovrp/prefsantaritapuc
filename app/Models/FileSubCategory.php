<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iconMenu',
        'file_category_id'
    ];

    public function fileCategories(){
        return $this->belongsTo(FileCategory::class);
    }
}
