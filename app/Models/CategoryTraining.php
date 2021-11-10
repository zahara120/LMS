<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubcategoryTraining;

class CategoryTraining extends Model
{
    //use HasFactory;
    protected $fillable = ['nameCategory'];

    public function subcategory(){
        return $this->hasMany('App\Models\SubcategoryTraining');
    }

    public function approval(){
        return $this->hasMany('App\Models\Approval');
    }
}