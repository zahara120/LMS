<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = ['titleTraining', 'category_id', 'quota', 'description', 'objectiveTraining', 'backgroundTraining'];
    use HasFactory;
    public function category(){
        return $this->belongsTo('App\Models\CategoryTraining');
    }
}