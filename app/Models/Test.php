<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function question()
    {
        return $this->hasMany('App\Models\Question');
    }

    public function training(){
        return $this->hasMany('App\Models\Training');
    }
}