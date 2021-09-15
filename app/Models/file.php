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
        'ext',
        'internal_number',
        'internal_type',
        'simple_name',
        'file_category_id',
        'file_sub_category_id'
    ];

    public function fileCategory(){
        return $this->belongsTo(FileCategory::class);
    }

    public function fileSubCategory(){
        return $this->belongsTo(FileSubCategory::class);
    }
}
