<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistTraining extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'regist_training';

    public function training(){
        return $this->belongsTo(Training::class, 'training_id');
    }
    
    public function regist(){
        return $this->belongsTo(Regist::class, 'regist_id');
    }

}
