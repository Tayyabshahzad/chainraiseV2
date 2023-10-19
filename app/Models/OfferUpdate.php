<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'update',
        'updated_at'
    ];

    public function offer(){
        return $this->belongsTo(Offer::class);
    }
}
