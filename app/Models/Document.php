<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Document extends Model  implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    function folder(){
        return $this->belongsTo(Folder::class);
    }
}
