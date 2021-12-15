<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function room(){
        return $this->hasMany('App\Models\Room');
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }
}