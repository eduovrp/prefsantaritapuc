<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'month',
        'tag',
        'local',
        'desc',
        'first_img',
        'second_img'
    ];
}
