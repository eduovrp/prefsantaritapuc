<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filesCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iconMenu'
    ];

    public function filesSubCategories(){
        return $this->hasMany(filesSubCategory::class);
    }

    public static function menu(){
        return filesCategory::all();
    }
}
