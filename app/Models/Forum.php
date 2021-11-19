<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

class Forum extends Model
{
    //protected $table ="forums";
    use HasFactory;
    use Sluggable;

    //fillable kecuali "id"
    protected $guarded = ['id'];

    public function sluggable() : array
    {
        return[
            'slug' => ['source'=> 'titleForum']
        ];
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    public function is_liked()
    {
        return $this->likes->where('user_id', Auth::user()->id)->count();
    }
}