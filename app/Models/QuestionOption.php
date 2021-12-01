<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
     use HasFactory;
    protected $guarded = ['id'];
    //protected $fillable = ['option_text'];
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

}