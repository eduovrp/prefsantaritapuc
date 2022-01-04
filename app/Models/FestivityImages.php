<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FestivityImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'src',
        'festivity_id',
        'fileName',
        'folderName'
    ];

    public function festivities(){
        return $this->belongsTo(Festivity::class);
    }
}
