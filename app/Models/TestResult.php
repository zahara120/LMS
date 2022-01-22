<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function training(){
        return $this->belongsTo(Training::class, 'training_id');
    }
    public function pretest(){
        return $this->belongsTo(Test::class, 'pretest_id');
    }
    
    public function posttest(){
        return $this->belongsTo(Test::class, 'posttest_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
