<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'href',
        'simple_name',
        'file_category_id'
    ];

    public function fileCategory(){
        return $this->belongsTo(FileCategory::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
