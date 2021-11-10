<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['nameRole'];

    public function user(){
        // return $this->belongsTo(User::class);
        return $this->belongsToMany('App\Models\User');
    }
    
    public function permission(){
        return $this->belongsToMany(Permission::class);
    }

    
}