<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'investor_id',
        'issuer_id',
        'security_type',
        'question',
        'answer',
        'status',
    ];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function investor(){
        return $this->belongsTo(User::class,'investor_id');
    }
}
