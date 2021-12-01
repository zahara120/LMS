<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    //protected $fillable = ['question'];
    public function questionnaire()
    {
        return $this->belongsTo('App\Models\Questionnaire');
    }
}