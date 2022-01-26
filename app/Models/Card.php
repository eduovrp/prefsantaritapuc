<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'src_img',
        'src_img_onclick',
        'href',
        'folderName',
        'data_exp',
        'active'
    ];
}
