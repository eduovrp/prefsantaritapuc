<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iconMenu'
    ];

    public function fileSubCategories(){
        return $this->hasMany(FileSubCategory::class);
    }

    public static function menu(){
        return FileCategory::all();
    }
}
