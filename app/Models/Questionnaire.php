<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    //protected $fillable = ['question'];
    public function survey()
    {
        return $this->belongsTo('App\Models\Survey');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\Answer');
    }
}