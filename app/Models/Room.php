<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['nameRoom','venue_id'];

    public function venue(){
        return $this->belongsTo('App\Models\Venue');
    }
}