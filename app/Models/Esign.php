<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esign extends Model
{
    use HasFactory;

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function issuer(){
        return $this->belongsTo(User::class,'issuer_id');
    }

    public function invester(){
        return $this->belongsTo(User::class,'invester_id');
    }
}
