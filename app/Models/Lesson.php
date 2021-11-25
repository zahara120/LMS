<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['nameLesson','description','file','url'];

    public function subcategory(){
        return $this->belongsTo('App\Models\SubcategoryTraining');
    }

    public function typelesson(){
        return $this->hasMany('App\Models\TypeLesson');
    }

    public function category(){
        return $this->belongsTo('App\Models\CategoryTraining');
    }
}