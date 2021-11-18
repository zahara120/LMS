<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function forum(){
        return $this->belongsTo('App\Models\Forum');
    }

    public function child(){
        return $this->hasMany(Comment::class,'parent_id');
    }
}