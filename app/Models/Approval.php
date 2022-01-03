<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo('App\Models\CategoryTraining', 'category_trainings_id');
    }
    
    public function approval_detail(){
        return $this->hasMany('App\Models\ApprovalDetail');
    }
}