<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function venue(){
        return $this->belongsTo('App\Models\Venue');
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }
}