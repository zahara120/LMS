<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function forum(){
        return $this->belongsTo('App\Models\Forum');
    }

    public function childs(){
        return $this->hasMany(Comment::class,'parent');
    }
}