<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'src_img',
        'date',
        'category_post_id'
    ];

    public function tags(){
        return $this->hasMany(Tag::class);
    }

    public function categoryPost(){
        return $this->belongsTo(CategoryPost::class);
    }

    public static function posts(){
        return Post::orderBy('id','desc')->take(4)->get();
    }

}
