<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryTraining;

class SubcategoryTraining extends Model
{
    //use HasFactory;
    //protected $fillable = ['nameSubcategory','category_trainings_id','description'];
    protected $guarded = ['id'];

    public function lesson(){
        return $this->hasMany('App\Models\Lesson');
    }

    public function category(){
        return $this->belongsTo('App\Models\CategoryTraining', 'category_trainings_id');
    }
}