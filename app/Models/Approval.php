<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function category(){
        return $this->belongsTo('App\Models\CategoryTraining', 'category_trainings_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}