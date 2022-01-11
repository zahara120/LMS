<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function training(){
        return $this->belongsTo('App\Models\Training');
    }
    public function test(){
        return $this->belongsTo('App\Models\Test');
    }
}
