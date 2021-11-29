<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $table = 'regist';
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function training(){
        return $this->belongsTo(Training::class, 'training_id');
    }

    public function registTraining(){
        return $this->hasMany(RegistTraining::class);
    }
}