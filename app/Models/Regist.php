<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function training(){
        return $this->belongsTo(Training::class);
    }

    // public function training(){
    //     return $this->belongsToMany(Training::class, 'registration_training', 
    //     'regist_id', 'training_id');
    // }
    
}