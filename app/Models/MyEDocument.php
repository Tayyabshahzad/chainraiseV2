<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class MyEDocument extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function invester(){
        return $this->belongsTo(User::class,'investor_id');
    }

    public function issuer(){
        return $this->belongsTo(User::class,'issuer_id');
    }
}
