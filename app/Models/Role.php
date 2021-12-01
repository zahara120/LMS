<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['nameRole'];
    protected $table = 'roles';

    public function user(){
        // return $this->belongsTo(User::class);
        return $this->belongsToMany(User::class);
    }
    
    public function permission(){
        return $this->belongsToMany(Permission::class);
    }
}