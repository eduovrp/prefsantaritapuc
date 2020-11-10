<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'notice_id',
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
